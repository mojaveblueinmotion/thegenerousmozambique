<?php

namespace App\Models\CustomModule;

use App\Models\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Models\CustomModule\ModuleData;
use App\Models\Master\DatabaseMobil\Seri;

class Module extends Model
{
    protected $table = 'trans_custom_module';

    protected $fillable = [
        'title',
        'api',
        'description',
        'status',
    ];

    /*******************************
     ** MUTATOR
     *******************************/

    /*******************************
     ** ACCESSOR
     *******************************/

    /*******************************
     ** RELATION
     *******************************/

    public function details()
    {
        return $this->hasOne(ModuleDetail::class, 'module_id');
    }

    public function data()
    {
        return $this->hasOne(ModuleData::class, 'module_id');
    }

    /*******************************
     ** SCOPE
     *******************************/

    public function scopeFilters($query)
    {
        return $query->filterBy(['title']);
    }

    /*******************************
     ** SAVING
     *******************************/
    public function handleStoreOrUpdate($request)
    {
        $this->beginTransaction();
        try {
            $collection = [
                'module_title' => $request->title,
                'api' => strtolower(str_replace(' ', '-', $request->title)),
                'status' => $request->status,
                'body' => collect($request->details)->map(function ($item, $moduleId) use ($request) {
                    return [
                        'id' => $item['title_number'],
                        'heading' => $item['title'],
                        'data' => collect($item)->except(['title', 'title_number'])->map(function ($subItem, $subId) use ($item) {
                            // preg_match_all('/<p\s*>\s*<\/p>/', $subItem['value'], $matches);
                            preg_match_all('/<p[^>]*>(.*?)<\/p>/', $subItem['value'], $matches);
                            $cleanString = str_replace('<br>', '', $matches[1]);
                            $contentArray = array_map('trim', $cleanString);
                            // dd($cleanString);
                            // Modify this part to structure the "data" array as required
                            $data = collect($contentArray)
                            ->reject(function ($value) {
                                return $value == "";
                            })
                            ->map(function ($value) {
                                return [
                                    'value' => $value,
                                    'label' => $value,
                                ];
                            })
                            ->values()
                            ->all();

                            if($subItem['required'] == 'false'){
                                $required = false;
                            }else{
                                $required = true;
                            }

                            return [
                                'id' => $subId + 1, // Corrected the id generation
                                'type' => $subItem['type'],
                                "informationMsg" => $subItem['information'],
                                "informationStatus" => !empty($subItem['information']), // Check if 'information' is not empty
                                "key" => strtolower(str_replace(' ', '_', $subItem['title'])),
                                "data" => $data,
                                'title' => $subItem['title'],
                                'require' => $required,
                                'error' => "kolom " . $subItem['title'] ." mohon diisi"
                            ];
                        })->values()->all()
                    ];
                })->values()->all()
            ];


            $collection = collect($collection); // Convert to Laravel Collection
            $json = $collection->toJson();

            $this->fill($request->only($this->fillable));
            $this->api = strtolower(str_replace(' ', '-', $request->title));
            $this->description = $request->description;
            $this->save();
            $this->details()->delete();
            $detail = $this->details()->firstOrNew([
                'module_id' => $this->id,
                'data' => $json,
            ]);
            
            // Save the related model
            $detail->save();
            $this->saveLogNotify();

            $redirect = route(request()->get('routes') . '.index');
            return $this->commitSaved(compact('redirect'));
        } catch (\Exception $e) {
            return $this->rollbackSaved($e);
        }
    }

    public function handleDestroy()
    {
        $this->beginTransaction();
        try {
            $this->saveLogNotify();
            $this->delete();

            return $this->commitDeleted();
        } catch (\Exception $e) {
            return $this->rollbackDeleted($e);
        }
    }

    public function handleImport($request)
    {
        $this->beginTransaction();
        try {
            $file = TempFiles::find($request->uploads['temp_files_ids'][0]);
            if (!$file || !\Storage::disk('public')->exists($file->file_path)) {
                $this->rollback('File tidak tersedia!');
            }

            $filePath = \Storage::disk('public')->path($file->file_path);
            \Excel::import(new ExampleImport(), $filePath);

            $this->saveLogNotify();

            return $this->commitSaved();
        } catch (\Exception $e) {
            return $this->rollbackSaved($e);
        }
    }

    public function saveLogNotify()
    {
        $data = $this->name;
        $routes = request()->get('routes');
        switch (request()->route()->getName()) {
            case $routes.'.store':
                $this->addLog('Membuat Data '.$data);
                break;
            case $routes.'.update':
                $this->addLog('Mengubah Data '.$data);
                break;
            case $routes.'.destroy':
                $this->addLog('Menghapus Data '.$data);
                break;
        }
    }

    /*******************************
     ** OTHER FUNCTIONS
     *******************************/
    public function canDeleted()
    {
        return true;
    }
}

<html>

<head>
    <title>{{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset(config('base.logo.favicon')) }}">
    <style>
        * {
            box-sizing: border-box;
        }

        /** Define the margins of your page **/
        @page {
            margin: 1cm;
        }

        header {
            position: fixed;
            top: 0px;
            left: 0;
            right: 0;
            /*margin-left: 10mm;*/
            /*margin-right: 5mm;*/
            /*line-height: 35px;*/
        }

        footer {
            position: fixed;
            bottom: -40px;
            left: 0px;
            right: 0;
            height: 50px;
            /* line-height: 35px; */
        }

        body {
            margin-top: 3cm;
            font-size: 11pt;
            font-family: Arial, sans-serif;
        }

        .pagenum:before {
            content: counter(page);
            content: counter(page, decimal);
        }

        table {
            width: 100%;
            border: 1pt solid black;
            border-collapse: collapse;
        }

        tr th,
        tr td {
            border-bottom: 1pt solid black;
            border: 1pt solid black;
            border-right: 1pt solid black;
        }

        ul {
            margin: 0;
            padding-left: 20px;
        }

        .table-data {
            height: 44px;
            background-repeat: no-repeat;
            /*background-position: center center;*/
            border: 1px solid;
            /*text-align: justify;*/
            /*background-color: #ffffff;*/
            font-weight: normal;
            /*color: #555555;*/
            /*padding: 11px 5px 11px 5px;*/
            vertical-align: middle;
        }

        .table-data tr th,
        .table-data tr td {
            padding: 5px 8px;
        }

        .table-data tr td {
            vertical-align: top;
        }

        .page-break: {
            page-break-inside: always;
        }

        .nowrap {
            white-space: nowrap;
        }
    </style>
</head>

<body class="page">

    <main>
        <header>
            <table class="table-header" style="border:1px solid #002060; width: 100%; height: 100px;">
                <tr>
                    <td style="border:none; background-color: #d9e2f3; padding:5px 5px 5px 5px;" width="60px">
                        <img src="{{ config('base.logo.print') }}" style="width: 60px; height: 90px;">
                    </td>
                    <td style="border:none; padding:5px 30px 5px 5px; color: #002060; background-color: #d9e2f3;"
                        width="auto">
                        <p style="font-size: 16px; font-weight:bold; line-height: 5px;">{!! __('SPI - PERUMDA TIRTA PATRIOT') !!}</p>
                        <p style="font-size: 12px; line-height: 15px; font-style: italic;">
                            {!! __('Visi Perusahaan :') !!}<br>
                            {!! __('Menjadi perusahaan Penyedia Air Minum Yang Maju Dengan Pelayanan Prima Di Kota Bekasi') !!}
                        </p>
                    </td>
                    <td style="border:1px solid #002060; text-align: center; justify-content:center font-size: 10px; background; color:white; background-color: #44546a;"
                        width="150px">
                        <p style="font-size: 14px; font-weight: bold;">{!! __('Surat Tugas') !!}</p>
                        @if (isset($letter) && $letter->is_available == 'active')
                            <hr class="horizontal-line" style="border:1px solid #fff;">
                            <p style="font-size: 10px;">
                                {{ $letter->no_formulir }} | {{ $letter->no_formulir_tambahan }}
                            </p>
                        @endif
                    </td>
                </tr>
            </table>
        </header>
        <table style="border: none; width: 100%; font-size:11pt;text-align:center;">
            <tr>
                <td colspan="3" style="border:none;">
                    <span style="text-decoration: underline; font-weight: bold;">SURAT TUGAS</span>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="border:none;">
                    <div>No. {{ $record->show_letter_no }}</div>
                    <br>
                </td>
            </tr>
        </table>
        <p style="text-align: justify;text-justify: inter-character">
            {!! $record->description !!}
        </p>
        <table style="border: none; width: 100%; font-size:11pt;">
            <tr style="border: none;">
                <td style="border: none; vertical-align: top; width: 150px">No. Dokumen</td>
                <td style="border: none; vertical-align: top; width: 1em">:</td>
                <td style="border: none; vertical-align: top;">
                    {{ $record->summary->rkia->no_audit_plan }}
                </td>
            </tr>
            <tr style="border: none;">
                <td style="border: none; vertical-align:top; width: 150px">Tanggal Pengesahan</td>
                <td style="border: none; vertical-align:top; width: 1em">:</td>
                <td style="border: none; vertical-align:top;">
                    {{ $record->letter_date->translatedFormat('d F Y') }}
                </td>
            </tr>
        </table>
        <p style="text-align: justify;text-justify: inter-character">
            Yang bertanda tangan dibawah ini :
        </p>
        @php
            $user = new \App\Models\Auth\User();
            $manajerSPI = $user->getManajerSPI();
        @endphp
        <table style="border:none; width: 100%;">
            <tr style="border: none;">
                <td style="border: none; vertical-align:top; width: 150px">Nama</td>
                <td style="border: none; vertical-align:top; width: 1em">:</td>
                <td style="border: none; vertical-align:top;">
                    {{ $manajerSPI->name }}
                </td>
            </tr>
            <tr style="border: none;">
                <td style="border: none; vertical-align:top; width: 150px">Jabatan</td>
                <td style="border: none; vertical-align:top; width: 1em">:</td>
                <td style="border: none; vertical-align:top;">
                    {{ $manajerSPI->position->name }}
                </td>
            </tr>
        </table>
        <p style="text-align: center;text-justify: inter-character;font-weight:bold;">
            MENUGASKAN
        </p>
        <table class="table-data" width="100%" border="1">
            <thead>
                <tr>
                    <th align="center">No</th>
                    <th align="center">{{ __('Nama') }}</th>
                    <th align="center">{{ __('Jabatan Tim') }}</th>
                    <th align="center">{{ __('Tujuan Audit') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1.</td>
                    <td>{{ $record->pic->name }}</td>
                    <td>Penanggung Jawab</td>
                    <td rowspan="{{ $record->members->count() + 3 }}">{{ $record->objective }}</td>
                </tr>
                <tr>
                    <td style="text-align: center;">2.</td>
                    <td>{{ $record->supervisor->name }}</td>
                    <td>Pengendali Teknis</td>
                </tr>
                <tr>
                    <td style="text-align: center;">3.</td>
                    <td>{{ $record->leader->name }}</td>
                    <td>Ketua Tim</td>
                </tr>
                @foreach ($record->members as $member)
                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration + 3 }}.</td>
                        <td>{{ $member->name }}</td>
                        <td>Anggota Tim</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="font-weight: bold;">
                        Waktu &nbsp;:
                        {{ $record->date_start->translatedFormat('d F Y') }} s.d
                        {{ $record->date_end->translatedFormat('d F Y') }} <br>
                        Pada &nbsp;&nbsp;&nbsp;: {{ $record->summary->getObjectName() }}
                    </td>
                </tr>
            </tfoot>
        </table>
        <p style="text-align: justify;text-justify: inter-character">
            {!! $record->penutup !!}
        </p>
        <div style="white-space: pre-wrap; text-align: justify;text-justify: inter-character;">{!! $record->note && '' !!}
            {{ $record->date_start->setTimezone('Asia/Jakarta')->translatedFormat('d F Y') . ' s/d ' . $record->date_end->setTimezone('Asia/Jakarta')->translatedFormat('d F Y') }}.
        </div>

        @if ($record->approval($module)->exists())
            <div style="page-break-inside: avoid;">
                <div style="text-align: center;">{{ ucwords(strtolower($record->getCityRoot())) }},
                    {{ $record->updated_at->translatedFormat('d F Y') }}<br>
                    {{ __('Menyetujui') }},</div>
                <table style="border:none;">
                    <tbody>
                        @php
                            $ids = $record
                                ->approval($module)
                                ->orderBy('order', 'DESC')
                                ->pluck('id')
                                ->toArray();
                            $length = count($ids);
                        @endphp
                        @for ($i = 0; $i < $length; $i += 4)
                            <tr>
                                @if (!empty($ids[$i]))
                                    <td style="border: none; text-align: center; width: 33%; vertical-align:top;">
                                        @if ($approval = $record->approval($module)->find($ids[$i]))
                                            @if ($approval->status == 'approved')
                                                <div style="height: 110px; padding-top: 15px;">
                                                    {!! \Base::getQrcode('Approved by: ' . $approval->user->name . ', ' . $approval->approved_at) !!}
                                                </div>

                                                <div class="" style="vertical-align:top!important;">
                                                    <div style="vertical-align:top!important;">
                                                        <b><u>{{ $approval->user->name }}</u></b>
                                                    </div>
                                                    <div>{{ $approval->position->name }}</div>
                                                </div>
                                            @else
                                                <div style="height: 110px; padding-top: 15px; color: #ffffff;">#</div>
                                                <div class="" style="vertical-align:top!important;">
                                                    <div style="vertical-align:top!important;">
                                                        <b><u>(............................)</u></b>
                                                    </div>
                                                    <div>{{ $approval->role->name }}</div>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endif
                                @if (!empty($ids[$i + 1]))
                                    <td style="border: none; text-align: center; width: 33%; vertical-align:top;">
                                        @if ($approval = $record->approval($module)->find($ids[$i + 1]))
                                            @if ($approval->status == 'approved')
                                                <div style="height: 110px; padding-top: 15px;">
                                                    {!! \Base::getQrcode('Approved by: ' . $approval->user->name . ', ' . $approval->approved_at) !!}
                                                </div>

                                                <div class="" style="vertical-align:top!important;">
                                                    <div style="vertical-align:top!important;">
                                                        <b><u>{{ $approval->user->name }}</u></b>
                                                    </div>
                                                    <div>{{ $approval->position->name }}</div>
                                                </div>
                                            @else
                                                <div style="height: 110px; padding-top: 15px;color: #ffffff;">#</div>
                                                <div class="" style="vertical-align:top!important;">
                                                    <div style="vertical-align:top!important;">
                                                        <b><u>(............................)</u></b>
                                                    </div>
                                                    <div>{{ $approval->role->name }}</div>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endif
                                @if (!empty($ids[$i + 2]))
                                    <td style="border: none; text-align: center; width: 33%; vertical-align:top;">
                                        @if ($approval = $record->approval($module)->find($ids[$i + 2]))
                                            @if ($approval->status == 'approved')
                                                <div style="height: 110px; padding-top: 15px;">
                                                    {!! \Base::getQrcode('Approved by: ' . $approval->user->name . ', ' . $approval->approved_at) !!}
                                                </div>

                                                <div class="" style="vertical-align:top!important;">
                                                    <div style="vertical-align:top!important;">
                                                        <b><u>{{ $approval->user->name }}</u></b>
                                                    </div>
                                                    <div>{{ $approval->position->name }}</div>
                                                </div>
                                            @else
                                                <div style="height: 110px; padding-top: 15px;color: #ffffff;">#</div>
                                                <div class="" style="vertical-align:top!important;">
                                                    <div style="vertical-align:top!important;">
                                                        <b><u>(............................)</u></b>
                                                    </div>
                                                    <div>{{ $approval->role->name }}</div>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                @if (!empty($ids[$i + 3]))
                                    <td style="border: none; text-align: center; width: 100%; vertical-align:top;"
                                        colspan="3">
                                        @if ($approval = $record->approval($module)->find($ids[$i + 3]))
                                            @if ($approval->status == 'approved')
                                                <div style="height: 110px; padding-top: 15px;">
                                                    {!! \Base::getQrcode('Approved by: ' . $approval->user->name . ', ' . $approval->approved_at) !!}
                                                </div>

                                                <div class="" style="vertical-align:top!important;">
                                                    <div style="vertical-align:top!important;">
                                                        <b><u>{{ $approval->user->name }}</u></b>
                                                    </div>
                                                    <div>{{ $approval->position->name }}</div>
                                                </div>
                                            @else
                                                <div style="height: 110px; padding-top: 15px;color: #ffffff;">#</div>
                                                <div class="" style="vertical-align:top!important;">
                                                    <div style="vertical-align:top!important;">
                                                        <b><u>(............................)</u></b>
                                                    </div>
                                                    <div>{{ $approval->role->name }}</div>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endif
                            </tr>

                        @endfor
                    </tbody>
                </table>
                <footer>
                    <table table width="100%" border="0" style="border: none;">
                        <tr>
                            <td style="border: none;">
                                <small>
                                    <i>***Dokumen ini sudah ditandatangani secara elektronik oleh
                                        {{ getRoot()->name }}.</i>
                                    <br><i>Tanggal Cetak: {{ now()->translatedFormat('d F Y H:i:s') }} ***Versi
                                        {{ $record->version ?? 0 }}</i>
                                </small>
                            </td>
                        </tr>
                    </table>
                </footer>
            </div>
        @endif
        <br>
        <div style="clear: both"></div>
        <div style="page-break-inside: avoid;">
            <div style="text-align: left;">{{ __('Tembusan') }}:</div>
            <ol>
                @if ($record->cc()->exists())
                    @foreach ($record->cc()->get() as $cc)
                        <li>Yth. {{ $cc->position->name }}</li>
                    @endforeach
                @else
                @endif
                <li>Arsip</li>
            </ol>
        </div>
    </main>
</body>

</html>

<table>
    <thead>
        <tr>
            <th style="text-align: center; vertical-align: center; font-weight: bold; background-color: #B5B5C3;">
                {{ strtoupper('No') }}
            </th>
            <th style="text-align: center; vertical-align: center; font-weight: bold; background-color: #B5B5C3; width: 10cm;">
                {{ strtoupper(__('Direksi')) }}
            </th>
            <th style="text-align: center; vertical-align: center; font-weight: bold; background-color: #B5B5C3; width: 10cm; height: 1.5cm;">
                {{ strtoupper('Parent') }}
                <br>
                (<a href="{{ route('setting.org.bod.index') }}">Lihat Master {{ __('Direksi') }}</a>)
            </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

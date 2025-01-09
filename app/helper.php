<?php

function apiResponse($message, $code, $data = [])
{
    return response()->json([
        'statuscode'    => $code,
        'message'       => $message,
        'data'          => $data
    ], $code);
}

function includeRouteFiles($folder)
{
    $directory = $folder;
    $handle = opendir($directory);
    $directory_list = [$directory];

    while (false !== ($filename = readdir($handle))) {
        if ($filename != '.' && $filename != '..' && is_dir($directory . $filename)) {
            array_push($directory_list, $directory . $filename . '/');
        }
    }

    foreach ($directory_list as $directory) {
        foreach (glob($directory . '*.php') as $filename) {
            require $filename;
        }
    }
}

function hariIndo($N)
{
    $hari   = [
        '1'       => 'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    ];

    return $hari[$N];
}

function indoDateFull($date)
{
    return hariIndo(date('N', strtotime($date))) . ', ' . tanggalIndo(date('Y-m-d', strtotime($date))) . ' ' . date('H:i', strtotime($date));
}

function tanggalIndo($date)
{
    $bulan = [
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    $split = explode('-', $date);

    return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}

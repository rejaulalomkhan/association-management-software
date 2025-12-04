<?php

return [
    'show_warnings' => false,
    'public_path' => null,

    'log_output_file' => storage_path('logs/dompdf.html'),

    'convert_entities' => true,

    // DomPDF options
    'options' => [
        // Logical default font name used by DomPDF
        'defaultFont' => 'bangla',
        'isRemoteEnabled' => true,
    ],

    // Where DomPDF will look for font files
    'font_dir' => storage_path('fonts/'),

    // Where DomPDF will cache generated font metrics
    'font_cache' => storage_path('fonts/'),

    'temp_dir' => storage_path('app/dompdf/temp/'),

    'chroot' => realpath(base_path()),

    // Laravel wrapper default font (should match logical name above)
    'default_font' => 'bangla',

    // Custom font mapping: put a Bangla-capable TTF in storage/fonts/
    // Example file name: storage/fonts/NotoSansBengali-Regular.ttf
    'fonts' => [
        'bangla' => [
            'normal' => storage_path('fonts/NotoSansBengali-Regular.ttf'),
            'bold' => storage_path('fonts/NotoSansBengali-Regular.ttf'),
            'italic' => storage_path('fonts/NotoSansBengali-Regular.ttf'),
            'bold_italic' => storage_path('fonts/NotoSansBengali-Regular.ttf'),
        ],
    ],
];

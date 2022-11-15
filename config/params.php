<?php

return [
    'bsVersion' => '4.x',
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'account_classes' => ['0' => '', '1' => 'Normal', '2' => 'De Efectivo', '3' => 'De Impuestos', '4' => 'De Ajustes por Inflación', '5' => 'De Nómina Contable'],
    'retentions' => [
        'calculation_type' => [0 => '', 1 => 'Porcentaje', 2 => 'Valor', 3 => 'Valor por Cantidad'],
        'movement_type' => [0 => '', 1 => 'Generar una cuenta por cobrar', 2 => 'Generar una cuenta por pagar', 3 => 'Llevar al ingreso', 4 => 'Llevar al gasto'],
        'payment_table' => [0 => '', 1 => 'CESANTIAS', 2 => 'EPS, ARP, PENSION', 3 => 'INTCESANTIAS', 4 => 'IVA', 5 => 'PAGO RENTAS', 6 => 'PRIMAS', 7 => 'RETENCION', 8 => 'VACACIONES'],
        'third_id' => [0 => '', 1 => 'ADMINIMP', 2 => 'ADMMPAL', 3 => 'ARP', 4 => 'CCF', 5 => 'CESANTIAS', 6 => 'EPS', 7 => 'ICBF'],
        'how_affects' => [0 => '', 1 => 'Resta al total a pagar ', 2 => 'No suma ni resta al total', 3 => 'Suma al total a pagar'],
    ],
    'document_type' => [0 => '', 1 => 'Manual', 2 => 'Automática', 3 => 'Tipo de Factura de Venta'],
    'cash_bank' => ['movement_type' => [1 => 'CE - Tranferencia y/o Retiro', 2 => 'CH - Cheques girados a la fecha', 3 => 'CHF - Cheques girados pos fechado']],
    'invoices' => ['class' => [1 => 'Clase 1', 2 => 'Clase 2', 3 => 'Clase 3', 4 => 'Clase 4', 5 => 'Clase 5']],
    'bills_of_sale' => ['class' => [1 => 'Clase 1', 2 => 'Clase 2', 3 => 'Clase 3', 4 => 'Clase 4', 5 => 'Clase 5'],
        'type_op' => [1 => 'AIU', 2 => 'Estándar', 3 => 'Mandatos', 4 => 'Transporte', 5 => 'Cambiario'],
        ],
    'company' => [
        'doc_type' => [1 => 'Registro civil de nacimiento', 2 => 'Tareta de identidad', 3 => 'Cédula de ciudadanía', 4 => 'Nit'],
        'tax_profiles' => [1 => 'Para personas naturales régimen ordinario de tributación', 2 => 'Para personas jurídicas régimen ordinario de tributación', 3 => 'Para personas naturales régimen simple de tributación', 4 => 'Para personas jurídicas régimen simple de tributación'],
        'header_type' => [1 => 'Rótulo', 2 => 'Logotipo', 3 => 'Ninguno'],
    ],
    'hq' => [
        'class_cc' => [1 => 'Gastos', 2 => 'Ventas', 3 => 'Producción', 4 => 'No operacional', 5 => 'Costos indirectos de fabricación'],
        'categories' => [1 => 'Comercial', 2 => 'Servicios', 3 => 'Manufactura por órdenes de producción', 4 => 'Manufactura por líneas de producción'],
    ],
    'third_parties' => [
        'doc_type' => [1 => 'Registro civil de nacimiento', 2 => 'Tareta de identidad', 3 => 'Cédula de ciudadanía', 4 => 'Nit'],
        'banks' => [1 => 'Bancolombia', 2 => 'Banco de Bogotá', 3 => 'Banco Popular', 4 => 'Banco Santander', 5 => 'Citibank', 6 => 'HSBC'],
        'account_type' => [1 => 'Cuenta de Ahorro', 2 => 'Cuenta Corriente', 3 => 'Cuenta de Ahorro AFC', 4 => 'Cuenta de Ahorro Programada', 5 => 'Cuenta de Nómina'],
    ]
];

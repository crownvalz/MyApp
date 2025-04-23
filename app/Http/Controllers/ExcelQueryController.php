<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ExcelQueryController extends Controller
{
    public function saveExcelTable(Request $request)
    {
        $headers = $request->headers ?? [];
        $rows = $request->rows ?? [];

        if (empty($headers) || empty($rows)) {
            return response()->json(['message' => 'Invalid data provided'], 400);
        }

        // Determine next available table name
        $existingTables = DB::select("SHOW TABLES");
        $baseName = 'excel_table';
        $i = 1;

        $tableNames = array_map(fn($obj) => reset((array)$obj), $existingTables);
        while (in_array($baseName . $i, $tableNames)) {
            $i++;
        }

        $newTableName = $baseName . $i;

        // Create the table
        Schema::create($newTableName, function (Blueprint $table) use ($headers) {
            $table->id();
            foreach ($headers as $header) {
                $columnName = preg_replace('/[^a-zA-Z0-9_]/', '_', strtolower($header));
                $table->text($columnName)->nullable();
            }
            $table->timestamps();
        });

        // Insert rows
        foreach ($rows as $row) {
            $data = [];
            foreach ($headers as $index => $header) {
                $columnName = preg_replace('/[^a-zA-Z0-9_]/', '_', strtolower($header));
                $data[$columnName] = $row[$index] ?? null;
            }

            DB::table($newTableName)->insert($data);
        }

        return response()->json(['message' => "Table '{$newTableName}' created and data inserted successfully."]);
    }
}
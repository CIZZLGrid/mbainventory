<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Users extends BaseController
{
    public function delete($id)
    {
        $model = new UserModel();

        $model->delete($id);

        return redirect()->to('/users/product');
    }
    public function product()
    {
        $model = new Usermodel();

        $sims = $model
                ->orderBy('gateway', 'ASC')
                ->orderBy('sim_gateway', 'ASC')
                ->findAll();

        $data = [
            'sims' => $sims
        ];


        return view('users/product', $data);
    }
    public function globe_sim()
    {
        return view('layout/add_globe');    
    }
    public function smart_sim()
    {
        return view('layout/add_smart');    
    }
    public function add_globe()
    {
        $model = new UserModel();

        $model->save([
            'sim_gateway' => $this->request->getPost('sim_gateway'),
            'sim_id' => $this->request->getPost('sim_id'),
            'sim_no' => $this->request->getPost('sim_no'),
            'plan' => $this->request->getPost('plan'),
            'call_to' => $this->request->getPost('call_to'),
            'sms_to' => $this->request->getPost('sms_to'),
            'operator' => $this->request->getPost('operator'),
            'gateway' => $this->request->getPost('gateway'),
            'ip_address' => $this->request->getPost('ip_address'),

        ]);

        return redirect()->back()->with('success', 'Globe SIM added successfully.'); 
    }
    public function add_smart()
    {
        $model = new UserModel();

        $model->save([
            'sim_gateway' => $this->request->getPost('sim_gateway'),
            'sim_id' => $this->request->getPost('sim_id'),
            'sim_no' => $this->request->getPost('sim_no'),
            'plan' => $this->request->getPost('plan'),
            'call_to' => $this->request->getPost('call_to'),
            'sms_to' => $this->request->getPost('sms_to'),
            'operator' => $this->request->getPost('operator'),
            'gateway' => $this->request->getPost('gateway'),
            'ip_address' => $this->request->getPost('ip_address'),
            
        ]);

        return redirect()->back()->with('success', 'Smart SIM added successfully.');    
    }
    public function edit_sim($id)
    {
        $model = new UserModel();

        $data['sims'] = $model->find($id);

        return view('layout/edit_sim', $data);
    }
    public function update_sim($id)
    {
        $model = new UserModel();

        $model->update($id, [
            'sim_gateway' => $this->request->getPost('sim_gateway'),
            'sim_id' => $this->request->getPost('sim_id'),
            'sim_no' => $this->request->getPost('sim_no'),
            'plan' => $this->request->getPost('plan'),
            'call_to' => $this->request->getPost('call_to'),
            'sms_to' => $this->request->getPost('sms_to'),
            'operator' => $this->request->getPost('operator'),  
            'gateway' => $this->request->getPost('gateway'),
            'ip_address' => $this->request->getPost('ip_address'),
        ]);
         return redirect()->to('/users/product');

    }
    public function deleteSelected()
    {
        $selectedIds = $this->request->getPost('selected_ids');

        if (!$selectedIds) {
            return redirect()->back()->with('error', 'No rows selected.');
        }

        $selectedIds = array_map('intval', $selectedIds);

        $model = new SimModel();

        $model->whereIn('id', $selectedIds)->delete();

        return redirect()->back()->with('success', 'Selected rows deleted successfully.');
    }
    public function gateway_visual()
    {
        $model = new UserModel();

        $data['sims'] = $model->
            orderBy('gateway', 'ASC')
            ->orderBy('sim_gateway', 'ASC')
            ->findAll();

        return view('users/gateway_visual', $data);
    }
    public function export()
    {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Sim Gateway');
        $sheet->setCellValue('B1', 'Sim ID');
        $sheet->setCellValue('C1', 'Sim No');
        $sheet->setCellValue('D1', 'Operator');
        $sheet->setCellValue('E1', 'Gateway');
        $sheet->setCellValue('F1', 'IP Address');
        $sheet->setCellValue('G1', 'Plan');
        $sheet->setCellValue('H1', 'Call To');
        $sheet->setCellValue('I1', 'SMS To');
        $sheet->setCellValue('J1', 'Date');

        $model = new UserModel();
        $data = $model->findall();

        $row = 2;

        $breakpoints = [2, 35, 68, 101, 134, 167, 200, 233, 266, 299, 332, 365, 398, 431, 464, 497, 530, 563, 596, 629, 662, 695, 728, 761, 794, 827, 860, 893, 926, 959];

        $gatewayIndex = $data[0]['gateway'];

        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        foreach ($data as $sim)
        {
        
            if (in_array($row, $breakpoints))
            {
                $sheet->setCellValue('A' . $row, 'Gateway ' . $gatewayIndex);
                $sheet->mergeCells("A{$row}:J{$row}");
                $sheet->getStyle("A{$row}:J{$row}")->getFont()->setBold(true)->setSize(16);

                $sheet->getStyle("A{$row}:J{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $row++;
                $gatewayIndex++;
            }

            // Data rows
            $sheet->setCellValue('A' . $row, $sim['sim_gateway']);
            $sheet->setCellValue('B'. $row, $sim['sim_id']);
            $sheet->setCellValue('C'. $row, $sim['sim_no']);
            $sheet->setCellValue('D'. $row, $sim['operator']);
            $sheet->setCellValue('E'. $row, $sim['gateway']);
            $sheet->setCellValue('F'. $row, $sim['ip_address']);
            $sheet->setCellValue('G'. $row, $sim['plan']);
            $sheet->setCellValue('H'. $row, $sim['call_to']);
            $sheet->setCellValue('I'. $row, $sim['sms_to']);
            $sheet->setCellValue('J'. $row, $sim['date']);

            $row++;
        }

                $filename = 'Sim_Card_Inventory.xlsx';

                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');   

                header('Cache-Control: max-age=0');

                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output');
                exit;

    }
    public function dashboard()
    {
        $filePath = $this->getLatestInventoryFile();

        $data = [
            'active' => 0,
            'inactive' => 0,
            'total' => 0,
        ];

        if ($filePath !== null) {
            $data = $this->scanExcelFile($filePath);
        }

        return view('users/dashboard', $data);
    }

    private function getLatestInventoryFile()
    {
        $uploadPath = WRITEPATH . 'uploads/';

        $files = [
            $uploadPath . 'latest_inventory.csv',
            $uploadPath . 'latest_inventory.xlsx',
            $uploadPath . 'latest_inventory.xls',
        ];

        foreach ($files as $file) {
            if (file_exists($file)) {
                return $file;
            }
        }

        return null;
    }

    public function scanExcelFile($filePath)
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();

        $rows = $sheet->toArray(null, true, true, true);

        $active = 0;
        $inactive = 0;

        if (empty($rows)) {
            return [
                'active' => 0,
                'inactive' => 0,
                'total' => 0,
            ];
        }

        // First row: GATEWAY, SIM0, SIM1, SIM2...
        $header = $rows[1];

        $simcolumns = [];

        foreach ($header as $columnLetter => $columnName) {
            $colName = strtoupper(trim((string) $columnName));

            if (preg_match('/^SIM\s*\d+$/', $colName)) {
                $simcolumns[] = $columnLetter;
            }
        }

        for ($i = 2; $i <= count($rows); $i++) {
            $row = $rows[$i];

            $gateway = trim((string) ($row['A'] ?? ''));

            if ($gateway === '') {
                continue;
            }

            foreach ($simcolumns as $columnLetter) {
                $value = strtoupper(trim((string) ($row[$columnLetter] ?? '')));

                if ($value === 'GOOD' || $value === 'LOW') {
                    $active++;
                } else {
                    $inactive++;
                }
            }
        }

        return [
            'active' => $active,
            'inactive' => $inactive,
            'total' => $active + $inactive,
        ];
    }

    public function uploadExcel()
    {
        $file = $this->request->getFile('excel_file');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Invalid file.');
        }

        $extension = strtolower($file->getClientExtension());

        $allowedExtensions = ['xlsx', 'xls', 'csv'];

        if (!in_array($extension, $allowedExtensions)) {
            return redirect()->back()->with('error', 'Only XLSX, XLS, or CSV files are allowed.');
        }

        $uploadPath = WRITEPATH . 'uploads/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Delete old daily inventory file
        foreach (['xlsx', 'xls', 'csv'] as $oldExtension) {
            $oldFile = $uploadPath . 'latest_inventory.' . $oldExtension;

            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        // Save using the real file extension
        $newFileName = 'latest_inventory.' . $extension;

        $file->move($uploadPath, $newFileName);

        return redirect()->to(base_url('users/dashboard'))
            ->with('success', 'Inventory file uploaded successfully.');
    }

    public function admin_management()
    {
        return view('users/admin_management');
    }

}


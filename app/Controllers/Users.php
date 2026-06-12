<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\InactiveSimModel;
use App\Models\GatewayIpMapModel;
use App\Models\AdminModel;
use App\Models\SimArchive;
use App\Libraries\TrustedTime;

class Users extends BaseController
{
    public function restore($id)
    {
        $model = new SimArchive();
        $activeModel = new UserModel();

        $sim = $model->find($id);

        if (!$sim) {
            return redirect()->to('users/product')->with('error', 'Sim not found');
        }

        try {
            $trustedTime = new TrustedTime();
            $now = $trustedTime->nowUtc();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cannot restore SIM because internet time cannot be verified.');
        }

        if (!empty($sim['restore_until_utc'])) {
            $restoreUntil = new \DateTimeImmutable($sim['restore_until_utc'], new \DateTimeZone('UTC'));

            if ($now > $restoreUntil) {
                $model->delete($id);

                return redirect()->to('users/archived_sims')
                    ->with('error', 'Restore period expired. SIM was permanently deleted.');
            }
        }

        $activeData = [
            'id' => $sim['original_id'],
            'added_by'  => $sim['added_by'],
            'edited_by' => $sim['edited_by'],
            'sim_gateway' => $sim['sim_gateway'],
            'sim_id' => $sim['sim_id'],
            'sim_no' => $sim['sim_no'],
            'operator' => $sim['operator'],
            'gateway' => $sim['gateway'],
            'ip_address' => $sim['ip_address'],
            'plan' => $sim['plan'],
            'call_to' => $sim['call_to'],
            'sms_to' => $sim['sms_to'],
            'date' => $now->format('Y-m-d H:i:s'),
        ];

        $activeModel->insert($activeData);

        $model->delete($id);

        return redirect()->back()->with('success', 'Sim restored successfully');
    }

    public function delete_archived($id)
    {
        $model = new SimArchive();

        $sim = $model->find($id);

        if (!$sim) {
            return redirect()->to('/users/archived_sims')
                ->with('error', 'Archived SIM not found.');
        }

        $model->delete($id);

        return redirect()->to('/users/archived_sims')
            ->with('success', 'Archived SIM permanently deleted.');
    }
    public function delete($id)
    {
        $model = new UserModel();
        $archiveModel = new SimArchive();

        $sim = $model->find($id);

        if (!$sim) {
            return redirect()->to('users/product')->with('error', 'Sim not found');
        }

        try {
            $trustedTime = new TrustedTime();
            $now = $trustedTime->nowUtc();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cannot delete SIM because internet time cannot be verified.');
        }

        $restoreUntil = $now->modify('+30 days');

        $archiveData = [
                'original_id' => $sim['id'],
                'added_by' => $sim['added_by'],
                'edited_by' => $sim['edited_by'],
                'sim_gateway' => $sim['sim_gateway'],
                'sim_id' => $sim['sim_id'],
                'sim_no' => $sim['sim_no'],
                'operator' => $sim['operator'],
                'gateway' => $sim['gateway'],
                'ip_address' => $sim['ip_address'],
                'plan' => $sim['plan'],
                'call_to' => $sim['call_to'],
                'sms_to' => $sim['sms_to'],

                'archived_by' => session()->get('username'),
                'archived_at' => $now->format('Y-m-d H:i:s'),

                'deleted_at_utc' => $now->format('Y-m-d H:i:s'),
                'restore_until_utc' => $restoreUntil->format('Y-m-d H:i:s'),
            ];

        $archiveModel->save($archiveData);

        $model->delete($id);

        return redirect()->back()->with('success', 'SIM deleted and archived successfully. You have 30 days to restore it.');
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
            'added_by'  => session()->get('username'),
            'edited_by' => session()->get('username'),
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
            'added_by'  => session()->get('username'),
            'edited_by' => session()->get('username'),
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
            'edited_by' => session()->get('username'),
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

        if (empty($selectedIds) || !is_array($selectedIds)) {
            return redirect()->back()->with('error', 'No rows selected.');
        }

        $selectedIds = array_filter(array_map('intval', $selectedIds));

        if (empty($selectedIds)) {
            return redirect()->back()->with('error', 'Invalid selected rows.');
        }

        $model = new UserModel();
        $archiveModel = new SimArchive();

        try {
            $trustedTime = new TrustedTime();
            $now = $trustedTime->nowUtc();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cannot delete selected SIMs because internet time cannot be verified.');
        }

        $restoreUntil = $now->modify('+30 days');

        $sims = $model->whereIn('id', $selectedIds)->findAll();

        if (empty($sims)) {
            return redirect()->back()->with('error', 'No SIM records found.');
        }

        foreach ($sims as $sim) {
            $archiveModel->save([
                'original_id' => $sim['id'],
                'added_by' => $sim['added_by'],
                'edited_by' => $sim['edited_by'],
                'sim_gateway' => $sim['sim_gateway'],
                'sim_id' => $sim['sim_id'],
                'sim_no' => $sim['sim_no'],
                'operator' => $sim['operator'],
                'gateway' => $sim['gateway'],
                'ip_address' => $sim['ip_address'],
                'plan' => $sim['plan'],
                'call_to' => $sim['call_to'],
                'sms_to' => $sim['sms_to'],
                'archived_by' => session()->get('username'),
                'archived_at' => $now->format('Y-m-d H:i:s'),
                'deleted_at_utc' => $now->format('Y-m-d H:i:s'),
                'restore_until_utc' => $restoreUntil->format('Y-m-d H:i:s'),
            ]);
        }

        $model->whereIn('id', $selectedIds)->delete();

        return redirect()->back()->with('success', 'Selected SIMs deleted and moved to archive successfully.');
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

        // Database SIM counts
        $model = new UserModel();

        $activeSims = $model
            ->where('plan', 'ACTIVE')
            ->countAllResults();

        $inactiveSims = (new UserModel())
            ->where('plan', 'INACTIVE')
            ->countAllResults();

        $data['dbactive'] = $activeSims;
        $data['dbinactive'] = $inactiveSims;
        $data['dbtotal'] = $activeSims + $inactiveSims;

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
    public function inactiveList()
    {
        $historyModel = new InactiveSimModel();
        $mapModel = new GatewayIpMapModel();

        $selectedGateway = $this->request->getGet('gateway');

        $builder = $historyModel
            ->select("
                sim_inactive_history.id,
                sim_inactive_history.ip_address,
                sim_inactive_history.sim_id,
                sim_inactive_history.inactive_since,
                DATEDIFF(CURDATE(), sim_inactive_history.inactive_since) AS days_inactive,
                gateway_ip_map.gateway_name,
                gateway_ip_map.gateway_no
            ")
            ->join(
                'gateway_ip_map',
                'gateway_ip_map.ip_address = sim_inactive_history.ip_address',
                'left'
            );

        if (!empty($selectedGateway)) {
            $builder->where('gateway_ip_map.gateway_no', $selectedGateway);
        }

        $inactiveSims = $builder
            ->orderBy('gateway_ip_map.gateway_no', 'ASC')
            ->orderBy('sim_inactive_history.sim_id', 'ASC')
            ->findAll();

        $gatewayOptions = $mapModel
            ->orderBy('gateway_no', 'ASC')
            ->findAll();

        return view('users/inactive_list', [
            'inactiveSims' => $inactiveSims,
            'gatewayOptions' => $gatewayOptions,
            'selectedGateway' => $selectedGateway
        ]);
    }
    
    public function saveInactiveHistory($filePath)
    {
        $historyModel = new InactiveSimModel();

        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();

        $rows = $sheet->toArray(null, true, true, true);

        if (empty($rows)) {
            return;
        }

        $header = $rows[1];

        $simcolumns = [];
        $latestExcelKeys = [];

        foreach ($header as $columnLetter => $columnName) {
            $colName = strtoupper(trim((string) $columnName));

            if (preg_match('/^SIM\s*\d+$/', $colName)) {
                $simcolumns[$columnLetter] = str_replace(' ', '', $colName);
            }
        }

        for ($i = 2; $i <= count($rows); $i++) {
            $row = $rows[$i];

            $gatewayFull = trim((string) ($row['A'] ?? ''));

            if ($gatewayFull === '') {
                continue;
            }

            $parts = explode('-', $gatewayFull);
            $ipAddress = trim(end($parts));

            foreach ($simcolumns as $columnLetter => $simId) {
                $value = strtoupper(trim((string) ($row[$columnLetter] ?? '')));

                // Save every cell that exists in the latest Excel
                $key = $ipAddress . '|' . $simId;
                $latestExcelKeys[] = $key;

                $existingHistory = $historyModel
                    ->where('ip_address', $ipAddress)
                    ->where('sim_id', $simId)
                    ->first();

                if ($value === 'GOOD' || $value === 'LOW') {
                    if ($existingHistory) {
                        $historyModel->delete($existingHistory['id']);
                    }
                } else {
                    if (!$existingHistory) {
                        $historyModel->insert([
                            'ip_address' => $ipAddress,
                            'sim_id' => $simId,
                            'inactive_since' => date('Y-m-d'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    } else {
                        $historyModel->update($existingHistory['id'], [
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    }
                }
            }
        }

        // Delete database records that no longer exist in latest Excel
        $oldRows = $historyModel->findAll();

        foreach ($oldRows as $old) {
            $oldKey = trim($old['ip_address']) . '|' . strtoupper(trim($old['sim_id']));

            if (!in_array($oldKey, $latestExcelKeys)) {
                $historyModel->delete($old['id']);
            }
        }
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

        // Full path of uploaded Excel/CSV
        $filePath = $uploadPath . $newFileName;

        // Save inactive history here
        $this->saveInactiveHistory($filePath);

        return redirect()->to(base_url('users/dashboard'))
            ->with('success', 'Inventory file uploaded and scanned successfully.');
    }

    public function admin_management()
    {
        $model = new AdminModel();

        $data['admins'] = $model
            ->where('role', 'admin')
            ->findAll();

        return view('users/admin_management', $data);
    }

    public function add_admin()
    {
        $model = new AdminModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $existing = $model->where('username', $username)->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Username already exists.');
        }

        $model->save([
            'username' => $username,
            'password' => $password,
            'role' => 'admin',
        ]);

        return redirect()->back()->with('success', 'Admin added successfully.');
    }

    public function delete_admin($id)
    {
        $model = new AdminModel();

        $admin = $model->find($id);

        if (!$admin || $admin['role'] === 'superadmin') {
            return redirect()->back()->with('error', 'Cannot delete this account.');
        }

        $model->delete($id);

        return redirect()->back()->with('success', 'Admin deleted successfully.');
    }
    public function edit_admin($id)
    {
        $model = new AdminModel();

        $admin = $model->find($id);

        if (!$admin || $admin['role'] === 'superadmin') {
            return redirect()->to('/users/admin_management')
                ->with('error', 'Cannot edit this account.');
        }

        return view('users/edit_admin', [
            'admin' => $admin
        ]);
    }

    public function update_admin($id)
    {
        $model = new AdminModel();

        $admin = $model->find($id);

        if (!$admin || $admin['role'] === 'superadmin') {
            return redirect()->to('/users/admin_management')
                ->with('error', 'Cannot update this account.');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $existing = $model
            ->where('username', $username)
            ->where('id !=', $id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Username already exists.');
        }

        $data = [
            'username' => $username,
        ];

        if (!empty($password)) {
            $data['password'] = $password;
        }

        $model->update($id, $data);

        return redirect()->to('/users/admin_management')
            ->with('success', 'Admin updated successfully.');
    }

    public function archived_sims()
    {
        $model = new SimArchive();

        try {
            $trustedTime = new TrustedTime();
            $now = $trustedTime->nowUtc();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cannot load archive because internet time cannot be verified.');
        }

        // Permanently delete expired archived SIMs
        $model
            ->where('restore_until_utc IS NOT NULL')
            ->where('restore_until_utc <=', $now->format('Y-m-d H:i:s'))
            ->delete();

        // Load only non-expired archived SIMs
        $archivedSims = $model
            ->where('restore_until_utc IS NOT NULL')
            ->where('restore_until_utc >', $now->format('Y-m-d H:i:s'))
            ->orderBy('archived_at', 'DESC')
            ->findAll();

        foreach ($archivedSims as &$sim) {
            $restoreUntil = new \DateTimeImmutable($sim['restore_until_utc'], new \DateTimeZone('UTC'));

            $secondsLeft = $restoreUntil->getTimestamp() - $now->getTimestamp();

            $sim['days_left'] = max(0, ceil($secondsLeft / 86400));
        }

        $data['archived_sims'] = $archivedSims;

        return view('users/archived_sims', $data);
    }
}


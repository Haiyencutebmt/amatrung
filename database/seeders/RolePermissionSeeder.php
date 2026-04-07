<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'display_name' => 'Quản trị viên'],
            ['name' => 'staff', 'display_name' => 'Nhân viên'],
            ['name' => 'user', 'display_name' => 'Người dùng'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                $role
            );
        }

        $permissions = [
            ['name' => 'manage_users', 'display_name' => 'Quản lý tài khoản'],
            ['name' => 'assign_roles', 'display_name' => 'Gán vai trò'],
            ['name' => 'assign_permissions', 'display_name' => 'Cấp quyền'],
            ['name' => 'view_permissions', 'display_name' => 'Xem danh sách quyền'],

            ['name' => 'view_patients', 'display_name' => 'Xem bệnh nhân'],
            ['name' => 'create_patients', 'display_name' => 'Thêm bệnh nhân'],
            ['name' => 'edit_patients', 'display_name' => 'Sửa bệnh nhân'],
            ['name' => 'delete_patients', 'display_name' => 'Xóa bệnh nhân'],

            ['name' => 'view_medical_records', 'display_name' => 'Xem bệnh án'],
            ['name' => 'create_medical_records', 'display_name' => 'Thêm bệnh án'],
            ['name' => 'edit_medical_records', 'display_name' => 'Sửa bệnh án'],
            ['name' => 'delete_medical_records', 'display_name' => 'Xóa bệnh án'],

            ['name' => 'view_prescriptions', 'display_name' => 'Xem đơn thuốc'],
            ['name' => 'create_prescriptions', 'display_name' => 'Thêm đơn thuốc'],
            ['name' => 'edit_prescriptions', 'display_name' => 'Sửa đơn thuốc'],
            ['name' => 'delete_prescriptions', 'display_name' => 'Xóa đơn thuốc'],

            ['name' => 'view_medicinal_herbs', 'display_name' => 'Xem dược liệu'],
            ['name' => 'create_medicinal_herbs', 'display_name' => 'Thêm dược liệu'],
            ['name' => 'edit_medicinal_herbs', 'display_name' => 'Sửa dược liệu'],
            ['name' => 'delete_medicinal_herbs', 'display_name' => 'Xóa dược liệu'],

            ['name' => 'view_articles', 'display_name' => 'Xem bài viết'],
            ['name' => 'create_articles', 'display_name' => 'Thêm bài viết'],
            ['name' => 'edit_articles', 'display_name' => 'Sửa bài viết'],
            ['name' => 'delete_articles', 'display_name' => 'Xóa bài viết'],

            ['name' => 'view_comments', 'display_name' => 'Xem bình luận'],
            ['name' => 'moderate_comments', 'display_name' => 'Kiểm duyệt bình luận'],
            ['name' => 'delete_comments', 'display_name' => 'Xóa bình luận'],

            ['name' => 'view_reports', 'display_name' => 'Xem báo cáo'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                $permission
            );
        }

        $adminRole = Role::where('name', 'admin')->first();
        $staffRole = Role::where('name', 'staff')->first();

        $allPermissionIds = Permission::pluck('id')->toArray();
        $adminRole->permissions()->sync($allPermissionIds);

        $staffPermissionNames = [
            'view_patients',
            'create_patients',
            'edit_patients',
            'view_medical_records',
            'create_medical_records',
            'edit_medical_records',
            'view_prescriptions',
            'create_prescriptions',
            'edit_prescriptions',
            'view_medicinal_herbs',
            'view_articles',
            'view_comments',
        ];

        $staffPermissionIds = Permission::whereIn('name', $staffPermissionNames)->pluck('id')->toArray();
        $staffRole->permissions()->sync($staffPermissionIds);
    }
}

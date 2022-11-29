<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contract\EmployeeRepositoryInterface;
use App\Enums\EmployeeStatusEnum;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use App\Models\Employee;

class DepartmentController extends Controller
{
    /**
     * TODO: 1. First issue. You need to bind a concrete instance of EmployeeRepositoryInterface
     */

    public function getActiveEmployees(EmployeeRepositoryInterface $employeeRepository, int $departmentId): JsonResponse
    {
        /**
         * TODO: 2. Second issue. Need find concrete department by $departmentId
         *
         * @var Department $department
         */
        $department = Department::find($departmentId);

        $employees = $employeeRepository->findActiveByDepartment($department);

        return response()->json($employees);
    }

    public function blockEmployees(int $departmentId): JsonResponse{

        /**
         * TODO: 4. Second issue. You need to find a specific department by $departmentId
         *
         * @var Department $department
         */
        $department = Department::find($departmentId);

        /**
         * TODO: 5. Five issue. We need to block all employees of the department
         * @see EmployeeStatusEnum
         */
  
        $employee=Employee::where('department_id','=',$department->id)->first();
        $employee->status=EmployeeStatusEnum::BLOCKED->id();
         $employee->save();

        return response()->json($employee);
    }
}

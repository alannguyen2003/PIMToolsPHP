<?php 

namespace App\Services\Impl;

use App\DTOs\Request\Employee\CreateEmployeeRequest;
use App\DTOs\Request\Employee\DeleteEmployeeRequest;
use App\DTOs\Request\Employee\UpdateEmployeeRequest;
use App\Repositories\IEmployeeRepository;
use App\Services\IEmployeeService;  
use Illuminate\Http\Request;
use Utils\Mappers\EmployeeMapper;

class EmployeeService implements IEmployeeService {
  private $employeeRepository;

  public function __construct(IEmployeeRepository $employeeRepository) {
    $this->employeeRepository = $employeeRepository;
  }
  public function findAll() {
    return $this->employeeRepository->findAll();
  }

  public function findById($id) {
    return $this->employeeRepository->findById($id);
  }

  public function getGroupByEmployeeId($id) {
    return $this->employeeRepository->getGroupOfEmployee($id);
  }

  public function create($data) {
    return $this->employeeRepository->create(new CreateEmployeeRequest(
      $data->visa,
      $data->firstName, 
      $data->lastName,
      $data->birthdate
    ));
  }

  public function update($data) {
    return $this->employeeRepository->update(new UpdateEmployeeRequest(
      $data->id,
      $data->visa,
      $data->firstName,
      $data->lastName,
      $data->birthdate
    ));
  }

  public function delete($data) {
    $this->employeeRepository->delete(new DeleteEmployeeRequest($data->id));
  }
}
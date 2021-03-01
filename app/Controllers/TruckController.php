<?php

namespace App\Controllers;

use App\Models\StatusModel;
use App\Models\TruckModel;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class TruckController extends BaseController
{

    /**
     * Get all active truck
     * @return ResponseInterface
     */
    public function getAllTruck(): ResponseInterface
    {
        $uri = $this->request->uri;
        $queryParam = $uri->getQuery();
        parse_str($queryParam, $params);
        $nextPage = $params && isset($params['page']) ? $params['page'] : 1;
        $perPage = $params && isset($params['per_page']) ? $params['per_page'] : BaseController::$perPage;
        $model = new TruckModel();
        $name = $params && isset($params['name']) ? $params['name'] : '';
        $city = $params && isset($params['city']) ? $params['city'] : '';
        $state = $params && isset($params['state']) ? $params['state'] : '';
        $zip = $params && isset($params['zip']) ? $params['zip'] : '';

        $trucks = $model->where('status_id !=', StatusModel::$DELETED)
                        ->like('name' , $name)
                        ->like('city' , $city)
                        ->like('state' , $state)
                        ->like('zip' , $zip)
                        ->orderBy('id' , 'desc')
                        ->paginate($perPage , 'default' , $nextPage);
        $data = [
            'data' => $trucks,
             'pagination' => [
                 'current_page' =>$model->pager->getCurrentPage(),
                 'total' =>$model->pager->getTotal(),
                 'per_page' => $model->pager->getPerPage(),
                 'last_page' => $model->pager->getLastPage(),
             ]
        ];
        return $this->successFailResponse($data ,  'Truck retrieved successfully' , BaseController::$SUCCESS );
    }

    /**
     * Add new truck details
     * @return ResponseInterface
     * @throws \ReflectionException
     */
    public function addTruck(): ResponseInterface
    {
        $rules = [
            'name' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->successFailResponse(null ,  $this->validator->getErrors() , ResponseInterface::HTTP_BAD_REQUEST );
        }

        $model = new TruckModel();
        $input['status_id'] = StatusModel::$ACTIVE;
        $model->save($input);
        return $this->successFailResponse($input ,  'Truck added successfully' , BaseController::$SUCCESS );
    }

    /**
     * Get Specific truck details by ID
     * @param $id
     * @return ResponseInterface
     */
    public function showTruck($id): ResponseInterface
    {
        try {

            $model = new TruckModel();
            $truck = $model->findTruckById($id);
            return $this->successFailResponse($truck , 'Truck retrieved successfully' , BaseController::$SUCCESS );
        } catch (Exception $e) {
            return $this->successFailResponse(null , 'Could not find truck for specified ID' , BaseController::$FAIL );
        }
    }

    /**
     * Update Truck Details
     * @param $id
     * @return ResponseInterface
     */
    public function updateTruckDetails($id): ResponseInterface
    {
        try {

            $model = new TruckModel();
            $model->findTruckById($id);

            $input = $this->getRequestInput($this->request);



            $model->update($id, $input);
            $truck = $model->findTruckById($id);
            return $this->successFailResponse($truck , 'Truck updated successfully' , BaseController::$SUCCESS );

        } catch (Exception $exception) {
            return $this->successFailResponse($truck ,  $exception->getMessage() , ResponseInterface::HTTP_NOT_FOUND );
        }
    }

    /**
     * Delete Truck Delete (Soft Delete)
     * @param $id
     * @return ResponseInterface
     */
    public function removeTruck($id): ResponseInterface
    {
        try {

            $model = new TruckModel();
            $truck = $model->findTruckById($id);
            $model->set('status_id' , StatusModel::$DELETED);
            $model->update($truck);
            return $this->successFailResponse(null ,  'Truck deleted successfully' , BaseController::$SUCCESS );

        } catch (Exception $exception) {
            return $this->successFailResponse(null ,  $exception->getMessage() , ResponseInterface::HTTP_NOT_FOUND );

        }
    }

}
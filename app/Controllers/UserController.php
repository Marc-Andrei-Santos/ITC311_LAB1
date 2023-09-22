<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    private $activity;
    public function __construct()
    {
       $this->activity = new \App\Models\UserModel();
    }

    public function index()
    {
        //nah
    }

    public function insert()
    {
        $ID = $_POST['ID'];
        $data = [
            'ProductName' => $this->request->getVar('ProdName'),
            'ProductDescription'=> $this->request->getVar('ProdDesc'),
            'ProductCategory'=> $this->request->getVar('ProdCat'),
            'ProductQuantity'=> $this->request->getVar('ProdQuan'),
            'ProductPrice'=> $this->request->getVar('ProdPr'),
        ];
        if ($ID!= null) {
            $this->activity->set($data)->where('ID', $ID)->update();
        } else {
               $this->activity->save($data);
        }
    
        return redirect()->to('/activity');
    }

    public function edit($ID)
        {
            $data = [
                'activity' => $this->activity->findAll(),
                'user' => $this->activity->where('ID', $ID)->first(),
            ];
            return view('homepage', $data);
        }

    public function getCategories()
    {
        // Fetch distinct ProductCategory values from your database
        $query = $this->distinct()
                      ->select('ProductCategory') // Select the ProductCategory column
                      ->get($this->table);

        return $query->getResultArray();
    }


    public function delete($ID)
    {
        $this->activity->delete($ID);
        return redirect()->to('/activity');
    }

    public function activity($activity)
    {
        echo $activity;
    }

    public function homepage()
    {
       $data['activity'] = $this->activity->findAll();
       return view('homepage', $data);
    }
}

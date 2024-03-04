<?php
namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Models\Company;

class CompanyRepository extends EloquentRepository implements RepositoryInterface
{
    public $user;

    public function __construct(Company $company)
    {
        parent::__construct($company);
        $this->company = $company;
    }

    /**
     * get user instance
     */
    public function getModel(){
        return $this->company;
    }

    public function updateCompany($model,$request){
        $data = [ 'name'=>$request->name,
            'email' => $request->email,
            'password' => $request->password,
            'url' => $request->url,
            'domain'=>$request->domain
        ];
        $this->update($model,$data);
        if($request->hasFile('logo_path')){
            $file = $this->storeLocalFile($request,'logo_path','company-logos');
            $this->update($model,['logo_path'=>$file]);
        }
    }

    public function createCompany($request){
        $data = [ 'name'=>$request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'url' => $request->url,
            'domain'=>$request->domain
        ];
        $company = $this->create($data);
        if($request->hasFile('logo_path')){
            $file = $this->storeLocalFile($request,'logo_path','company-logos');
            $this->update($company,['logo_path'=>$file]);
        }
    }
}
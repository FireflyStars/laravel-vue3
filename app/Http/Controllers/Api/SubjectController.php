<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\UserSubject;
use App\Services\SubjectService;
use Auth;
class SubjectController extends Controller
{
    protected $subjectService;

    public function __construct(SubjectService $subjectService){
        $this->subjectService = $subjectService;
    }
    public function index(){
        return $this->subjectService->findAll();
    }
}

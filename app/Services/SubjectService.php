<?php
namespace App\Services;

use App\Models\UserSubject;
use App\Repositories\SubjectRepository;
use Auth;
/**
 * Class SubjectService
 * @package App\Services
 */
class SubjectService{

    /**
     * @var subjectRepository
     */
    protected $subjectRepository;

    /**
     * @param subjectRepository $job
     */
    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }
    
    /**
     *
     * @return Subjects
     */
    public function findAll()
    {
        try {
            return $this->subjectRepository->findAll();
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }
}
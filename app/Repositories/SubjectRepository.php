<?php
namespace App\Repositories;

use App\Models\Subject;
use App\Models\UserSubject;
use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Resources\SubjectResource;
use Auth;

/**
 * Class SubjectRepository
 * @package App\Repository
 */
class SubjectRepository implements RepositoryInterface {

    /**
     * @var Subject
     */
    protected $Subject;

    /**
     * @param Subject $Subject
     */
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    /**
     * Get Subject by user_id
     *
     * @param $job_id
     * @return Subjects
     */
    public function findAll()
    {
        $subjects = $this->subject
                         ->join('user_subjects', 'subjects.id', '=', 'user_subjects.subject_id')
                         ->where('user_id', Auth::id())
                         ->select('subjects.name', 'subjects.id')->get();

        return SubjectResource::collection( $subjects );
    }
}
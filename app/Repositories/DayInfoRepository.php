<?php

namespace App\Repositories;

use Models\DayInfoModel;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;
//use Your Model

/**
 * Class DayInfoRepository.
 */
class DayInfoRepository extends BaseRepository
{
    private $dayInfoModel = null;

    public function __construct(DayInfoModel $dayInfoModel)
    {
        $this->dayInfoModel = $dayInfoModel;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return DayInfoModel::class;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $this->dayInfoModel->user_id = ($data['user_id']);
        $this->dayInfoModel->date = $data['date'];
        $this->dayInfoModel->day_status = $data['day_status'];
        $this->dayInfoModel->final_estimation = -1;
        $this->dayInfoModel->own_estimation = -1;
        $this->dayInfoModel->save();

    }

    public function createMultiple(array $data)
    {
        // TODO: Implement createMultiple() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function deleteById($id) : bool
    {
        // TODO: Implement deleteById() method.
    }

    public function deleteMultipleById(array $ids) : int
    {
        // TODO: Implement deleteMultipleById() method.
    }

    public function first(array $columns = ['*'])
    {
        // TODO: Implement first() method.
    }

    public function get(array $columns = ['*'])
    {
        // TODO: Implement get() method.
    }

    public function getById($id, array $columns = ['*']) : bool
    {
        // TODO: Implement getById() method.
    }

    public function getByColumn($item, $column, array $columns = ['*'])
    {
        // TODO: Implement getByColumn() method.
    }

    public function paginate($limit = 25, array $columns = ['*'], $pageName = 'page', $page = null)
    {
        // TODO: Implement paginate() method.
    }

    public function updateById($id, array $data, array $options = [])
    {
        // TODO: Implement updateById() method.
    }

    public function limit($limit)
    {
        // TODO: Implement limit() method.
    }

    public function orderBy($column,  $direction = 'asc')
    {
        // TODO: Implement orderBy() method.
    }

    public function where($column, $value, $operator = '=')
    {
        // TODO: Implement where() method.
    }

    public function whereIn($column, $value)
    {
        // TODO: Implement whereIn() method.
    }

    public function with($relations)
    {
        // TODO: Implement with() method.
    }

    public function lastTimetable()
    {
        $timetable = DB::table('timetables')
            ->select(DB::raw('id'))
            ->max('id');

        return $timetable;
    }

    public static function getDateOfLastTimetable($id)
    {
        $timetable = DB::table('timetables')
            ->where('user_id', '=', $id)
            ->orderBy('date','DESC');

        return $timetable->get('date');
    }

    public static function getStatusOfLastTimetable($id)
    {
        $lastTimetableId = (DB::table('timetables')
            ->select(DB::raw('id'))
            ->max('id') );
        //dd($lastTimetableId);
        $timetable = DB::table('timetables')
            ->where('user_id', '=', $id)
            ->where('id', '=', $lastTimetableId)
            ->orderBy('date','DESC')->get()->toArray();
        //dd($timetable[0]->day_status);
        return $timetable[0]->day_status;
    }

    public function updateDayStatus($request)
    {
        if($request){
            $lastTimetableId = $this->lastTimetable();
            DB::table('timetables')->where('id','=', $lastTimetableId)->update(array(
                'day_status' => $request["status"],
                'comment'   => $request['comment']
            ));

            return true;
        }

        return false;

    }

    public function getComment()
    {
        $id = $this->lastTimetable();
        $timetable = DB::table('timetables')
            ->where('user_id', '=', $id)
            ->orderBy('date','DESC');

        return $timetable->get('comment');
    }


}
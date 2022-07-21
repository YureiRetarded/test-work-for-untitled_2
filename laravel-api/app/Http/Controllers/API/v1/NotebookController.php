<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Resources\NotebookResource;
use App\Models\Notebook;
use App\Http\Requests\StoreNotebookRequest;
use App\Http\Requests\UpdateNotebookRequest;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;


class NotebookController extends Controller
{

    //Получение всех записей(постранично)
    public function index()
    {
        //Для выбора страниц
        //http://test.com/api/v1/notebook?page=2
        //По умолчанию открывается первая
        return NotebookResource::collection(Notebook::paginate(10));

    }

    //Получение всех записи по id
    public function show(Notebook $notebook)
    {
        return new NotebookResource($notebook);
    }

    //Добавлении записи в базу
    public function store(StoreNotebookRequest $request)
    {
        //В случае ошибки возвращает сообщение об ошибки
        try {

            $data = $request->validate([
                'fio' => ['required', 'max:255'],
                'phone' => ['required', 'max:255'],
                'email' => ['required', 'max:255']
            ]);

            if (isset($data['photo'])) {
                $data['photo'] = Storage::put('/images', $data['photo']);
            }
            $notebook = Notebook::create($data);
            return new NotebookResource($notebook);
        } catch (\Exception $e) {
            throw new HttpException(400, $e->getMessage());
        }

    }

    //Изменение записи по id
    public function update(UpdateNotebookRequest $request, Notebook $notebook)
    {
        //В случае ошибки возвращает сообщение об ошибки
        try {

            $data = $request->validate([
                'fio' => ['required', 'max:255'],
                'phone' => ['required', 'max:255'],
                'email' => ['required', 'max:255']
            ]);

            if (isset($data['photo'])) {
                $data['photo'] = Storage::put('/images', $data['photo']);
            }
            $notebook->update($data);
            $notebook->fresh();
            return new NotebookResource($notebook);
        } catch (\Exception $e) {
            throw new HttpException(400, $e->getMessage());
        }

    }

    //Удаление записи по id
    //Используется SoftDeletes
    public function destroy(Notebook $notebook)
    {

        try {
            $notebook->delete();
            return response()->json([
                'Message' => 'Notes was deleted'
            ]);

        } catch (\Exception $e) {
            throw new HttpException(404, $e->getMessage());
        }


    }
}

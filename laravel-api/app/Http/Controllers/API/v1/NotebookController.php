<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Resources\NotebookResource;
use App\Models\Notebook;
use App\Http\Requests\StoreNotebookRequest;
use App\Http\Requests\UpdateNotebookRequest;


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
        $data = $request->validated();
        $notebook = Notebook::create($data);
        return new NotebookResource($notebook);
    }

    //Изменение записи по id
    public function update(UpdateNotebookRequest $request, Notebook $notebook)
    {
        $data = $request->validated();
        $notebook->update($data);
        $notebook->fresh();
        return new NotebookResource($notebook);
    }

    //Удаление записи по id
    //Используется SoftDeletes
    public function destroy(Notebook $notebook)
    {
        $notebook->delete();
        return 'NotesDeleted';
    }
}

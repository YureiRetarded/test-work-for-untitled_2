<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotebookResource;
use App\Models\Notebook;
use App\Http\Requests\StoreNotebookRequest;
use App\Http\Requests\UpdateNotebookRequest;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;


class NotebookController extends Controller
{


    /**
     * @OA\Get(
     *     path="/notebook",
     *     summary="Get all notes",
     *     operationId="NotesAll",
     *     tags={"Notebook"},
     *     @OA\Parameter(
     *          name="page",
     *          in="query",
     *          description="The page number",
     *          required=false,
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="OK"
     *     )
     * )
     */
    //Получение всех записей(постранично)
    public function index()
    {
        //Для выбора страниц
        //http://test.com/api/v1/notebook?page=2
        //По умолчанию открывается первая
        //В случае неправильного указания страницы, возвращается первая
        return NotebookResource::collection(Notebook::paginate(10));

    }

    /**
     * @OA\Get(
     *     path="/notebook/{id}",
     *     summary="Get note by id",
     *     operationId="GetNoteById",
     *     tags={"Notebook"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="The id of nore",
     *          required=true,
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Note is found"
     *     ),
     *     @OA\Response(
     *          response="404",
     *          description="Note is not found"
     *     )
     * )
     */


    //Получение всех записи по id
    public function show(Notebook $notebook)
    {
        return new NotebookResource($notebook);
    }

//    /**
//     * @OA\Post(
//     *     path="/notebook",
//     *     summary="Adding note in db",
//     *     operationId="AddNote",
//     *     tags={"Notebook"},
//     *     @OA\RequestBody(
//     *     required=true,
//     *         @OA\JsonContent(
//     *             type="object",
//     *              @OA\Property(property="fio",type="string",example="AAA BBB CCC"),
//     *              @OA\Property(property="phone",type="string", example="123456789"),
//     *              @OA\Property(property="email",type="string", example="wwww@com.we"),
//     *
//     *         )
//     *     ),
//     *     @OA\Response(response=201, description="Successful created"),
//     *     @OA\Response(
//     *          response="500",
//     *          description="1"
//     *     )
//     *
//     * )
//     */
    /**
     * @OA\Post(
     *     path="/notebook",
     *     summary="Adding note in db",
     *     operationId="AddNote",
     *     tags={"Notebook"},
     *     @OA\RequestBody(
     *     @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="fio",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="company",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="birthday",
     *                     type="date"
     *                 ),
     *                 @OA\Property(
     *                      property="photo",
     *                      type="string",
     *                      format="binary"
     *                  ),
     *                 example={"fio": "aa vv bb", "email": "awdawd@a.aw", "phone": "12345678","company":"mvd","birthday":"1985-07-31"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created"),
     *     @OA\Response(response=422, description="Unprocessable Content"),
     *
     * )
     */

    //Добавлении записи в базу
    public function store(StoreNotebookRequest $request)
    {
        //В случае ошибки возвращает сообщение об ошибки
        try {
            $data = $request->validated();

            if (isset($data['photo'])) {
                $data['photo'] = Storage::put('/images', $data['photo']);
            }
            $notebook = Notebook::create($data);
            return new NotebookResource($notebook);
        } catch (\Exception $e) {
            throw new HttpException(400, $e->getMessage());
        }

    }


    /**
     * @OA\Post(
     *     path="/notebook/{id}",
     *     summary="Update note by id",
     *     operationId="UpdateNoteById",
     *     tags={"Notebook"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="The id of note",
     *          required=true,
     *     ),
     *     @OA\RequestBody(
     *    @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="fio",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="company",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="birthday",
     *                     type="date"
     *                 ),
     *                 @OA\Property(
     *                      property="photo",
     *                      type="string",
     *                      format="binary"
     *                  ),
     *                 example={"fio": "aa vv bb", "email": "awdawd@a.aw", "phone": "12345678","company":"mvd","birthday":"1985-07-31"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Note was updated"),
     *     @OA\Response(response=404, description="Note not found"),
     *     @OA\Response(response=422, description="Unprocessable Content"),
     * )
     */

    //Изменение записи по id
    public function update(UpdateNotebookRequest $request, Notebook $notebook)
    {
        //В случае ошибки возвращает сообщение об ошибки
        try {

            $data = $request->validated();

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

    /**
     * @OA\Delete(
     *     path="/notebook/{id}",
     *     summary="Delete note by id",
     *     operationId="DeleteNoteById",
     *     tags={"Notebook"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="The id of note",
     *          required=true,
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Note was deleted"
     *     ),
     *     @OA\Response(
     *          response="404",
     *          description="Note not found"
     *     )
     * )
     */

    //Удаление записи по id
    //Используется SoftDeletes
    public function destroy(Notebook $notebook)
    {

        try {
            $notebook->delete();
            return response('', 201);

        } catch (\Exception $e) {
            throw new HttpException(404, $e->getMessage());
        }


    }
}

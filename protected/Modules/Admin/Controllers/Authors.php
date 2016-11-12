<?php

namespace App\Modules\Admin\Controllers;

use App\Models\Author;
use T4\Http\E404Exception;
use T4\Mvc\Controller;
use T4\Orm\ModelDataProvider;

class Authors
    extends Controller
{
    public function actionDefault($page = 1)
    {
        $this->data->provider = new ModelDataProvider(Author::class);
        $this->data->page = $page;
    }

    public function actionEdit($id)
    {
        if ('new' == $id) {
            $item = new Author();
            $item->published = date('d.m.Y');
        } else {
            $item = Author::findByPK($id);
            if (empty($item)) {
                throw new E404Exception('Исполнитель\Группа не найдена');
            }
        }
        $this->data->item = $item;
    }

    public function actionSave($author)
    {
        $item = empty($author->__id) ? new Author() : Author::findByPK($author->__id);
        $item->fill($author);

        $item->save();

        $this->redirect('/admin/authors');
    }

    public function actionDelete($id)
    {
        $item = Author::findByPK($id);
        if (!empty($item)) {
            $item->delete();
        }
        $this->redirect('/admin/authors');
    }
}
<?php

use Illuminate\Http\Request;
use Carbon\Carbon;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/stations', function () {

    return  \App\Station::all();
    
});

Route::get('/stations/{id}/elements', function ($id) {
    $elements = \App\Station::find($id)->elements;
    $elements_f = $elements->each(function ($item){
        $item->name = $item->name->name;
    });
   return response()->json($elements_f);

});

Route::get('/stations/{id}/maintenances', function ($id) {

    $maintenances = \App\Station::find($id)->maintenances;
    $mainplus = $maintenances->each(function ($item) {
        $activity = \App\Activity::find($item->activity_id);
        $item->activity = $activity->name;
        $item->description = $activity->description;
    });
    return response()->json($mainplus);

});

Route::get('/maintenances', function () {
    $events = \App\Maintenance::all()->map(function ($m) {
        return collect([
            "id" => $m->id,
            "name" => $m->activity->name,
            "startdate" => $m->date,
            "enddate" => "" ,
            "starttime" => "" ,
            "endtime" => "",
            "color" => $m->activity->color,
            "url" => ""
        ]);
    });

    return response()->json(["monthly" => $events]);
});


Route::get('/maintenances/station/{station}/year/{year}/month/{month}',function ($station,$year,$month){

    if($month != 'all')
    {
        $maintenances = \App\Maintenance::where('station_id',$station)->where('year_mma',$year)->where('month_mma',$month)->get();
    }
    else
    {
        $maintenances = \App\Maintenance::where('station_id',$station)->where('year_mma',$year)->get();
    }


    $maintenances_formatted = $maintenances->map(function ($f) {
        $docs = '';
        if (isset($f->documents))
        {

            foreach ($f->documents as $document)
            {
                if($document->version != null)
                {
                    $docs = $docs.'<a href="/docs/reports/'.$document->path.'">'.$document->station->name.' '.$document->code.' '.$document->label.' v'.$document->version.'<i class="large download icon"></i></a><br><span>'.$document->pivot->check_observation.'</span><hr>';
                }
                else
                {
                    $docs = $docs.'<a href="/docs/reports/'.$document->path.'">'.$document->station->name.' '.$document->code.' '.$document->label.'<i class="large download icon"></i></a><br><span>'.$document->pivot->check_observation.'</span><hr>';
                }


            }

        }
        else
        {
            $docs = '-';
        }

    if($f->state == 'scheduled')
    {
        $status = 'Calendarizada';
    }
    if($f->state == 'in_process')
    {
        $status = 'En Proceso';
    }
    if($f->state == 'finished')
    {
        $status = 'Finalizada';
    }

        $buttons ='<a class="circular ui mini icon defaut button info-modal-link" href="/maintenances/'.$f->id.'/edit"  title="Editar" style="float:left;">
                    <i class="icon blue edit"></i></a>';
        $buttons.='<form id="del_" action="/maintenances/'.$f->id.'" method="post" onSubmit="if(!confirm(\'Estas seguro de eliminar la Mantencion !?, sus datos asociados podrian perderse\')){return false;}" >
            <input type="hidden" name="_method" value="delete">
            <input type="hidden" name="_token" value="'.csrf_token().'">
            <button class="circular mini ui icon defaut button" type="submit" title="Eliminar" style="float:left;"><i class="icon red remove"></i></button></form>';
        $buttons.='<a class="circular ui mini icon defaut button info-modal-link pop" href="/maintenances/'.$f->id.'/edit_comments"  title="Comentar" style="float:left;" data-content="Comentar!">
            <i class="icon blue comment"></i></a>';

    return [
        'station' =>'<small>'.$f->station->name.'</small>',
        'activity' =>'<small>'.$f->activity->name.'</small>',
        'year' => '<small>'.$f->year_mma.'</small>',
        'month' =>'<small>'.$f->month_mma.'</small>',
        'validation' => '<small>'.$f->execution_date.'<hr>'.$docs.'</small>',
        'mma_comment' => '<small>'.$f->mma_comment.'</small>',
        'company_comment' => '<small>'.$f->company_comment.'</small>',
        'status' => '<small>'.$status.'</small>',
        'actions' =>  $buttons
    ];
});

return $maintenances_formatted;

});

Route::get('/maintenances_assign/station/{station}/year/{year}/month/{month}',function ($station,$year,$month){

    if($month != 'all')
    {
        $maintenances = \App\Maintenance::where('station_id',$station)->where('year_mma',$year)->where('month_mma',$month)->get();
    }
    else
    {
        $maintenances = \App\Maintenance::where('station_id',$station)->where('year_mma',$year)->get();
    }


    $maintenances_formatted = $maintenances->map(function ($f) {


            $button_assing = '<a class="circular ui mini icon green button pop" href="/assign_document/'.$f->id.'" data-variation="inverted" data-placement="top"  title="Asignar Documento">
                <i class="plus left icon"></i><i class="file text icon"></i></a>';

            $docs = '';
            if (isset($f->documents))
            {

                foreach ($f->documents as $document)
                {
                    if($document->version != null)
                    {
                        $docs = $docs.$document->station->name.' '.$document->code.' '.$document->label.' v'.$document->version.'<a href="/docs/reports/'.$document->path.'"><i class="large download icon"></i></a><br><span>'.$document->pivot->check_observation.'</span><hr>';
                    }
                    else
                    {
                        $docs = $docs.$document->station->name.' '.$document->code.' '.$document->label.'<a href="/docs/reports/'.$document->path.'"><i class="large download icon"></i></a><br><span>'.$document->pivot->check_observation.'</span><hr>';
                    }

                }

                $docs = $docs;
            }
            else
            {
                $docs = $docs;
            }

            if($f->state == 'scheduled')
            {
                $status = 'Calendarizada';
            }
            if($f->state == 'in_process')
            {
                $status = 'En Proceso';
            }
            if($f->state == 'finished')
            {
                $status = 'Finalizada';
            }
            $activity = '<a href="#"  class="tiny ui basic button pop" data-placement="top" data-variation="inverted" title="'.$f->activity->description.'">'.$f->activity->name.'</a>';

            $comments_edit ='<a class="circular ui mini icon defaut button pop" href="/maintenances/'.$f->id.'/edit_comments" data-variation="inverted" title="Editar Comentarios"  data-content="Editar Comentario">
                        <i class="icon blue comment"></i></a>';


            return [
                'station' =>''.$f->station->name.'',
                'activity' =>''.$activity.'',
                'year' => ''.$f->year_mma.'',
                'month' =>''.$f->month_mma.'',
                'validation' => '<span class="ui label blue" title="Fecha de Verificacion"><i class="white calendar icon"></i>'.$f->execution_date.'</span><hr>'.$docs.'',
                'mma_comment' => ''.$f->mma_comment.'',
                'company_comment' => ''.$f->company_comment.''.$comments_edit,
                'status' => ''.$status.''
            ];
    });

return $maintenances_formatted;

});

Route::get('/valid_code/code/{code}/station/{station}',function ($code,$station){
    $document_code = \App\Document::where('code',$code)->where('station_id',$station)->first();
    if($document_code)
    {
        return 'usado';
    }
    else
    {
        return 'ok';
    }
});

Route::get('/valid_code_max/station/{station}',function ($station){
    $document_code = \App\Document::where('station_id',$station)->max('code');
    return $document_code+1;
});


Route::get('/documents/period/{period}/user/{user_id}',function ($period,$user_id){
    $data = array();

    if($period == "all"){
        $documents = \App\Document::all();
    }

    if($period <> "all"){
        $documents = \App\Document::where('period_id',$period)->get();
    }

    $user = \App\User::find($user_id);

    foreach ($documents as $f) {

        $buttons ='<a class="ui mini icon defaut button info-modal-link pop" href="/documents/'.$f->id.'"  title="Ver" style="float:left;" data-content="Ver Registro!"><i class="icon black eye"></i></a>';

        if($user->rol !='observer'){
            if($user->rol != 'admin'){
                if(date('Y-m-d') < $f->period->end_restriction_date){
                    $buttons.='<a class="ui mini icon defaut button info-modal-link pop" href="/documents/'.$f->id.'/edit"  title="Editar" style="float:left;" data-content="Editar Registro!"><i class="icon blue edit"></i></a>';
                }

                //Dudas sobre la ubicación por rol
                if ($f->contingency_id != null) {
                    //Ver contingencia ya existente
                    $contingency = '<a class="ui red basic button mini icon defaut" href="/contingencies/'.$f->contingency_id. '"><i class="icon exclamation triangle"></i> Ver Cont.</a>';
                } else {
                    //Crear una contingencia
                    //$contingency = $f->id;
                    $contingency = '<a class="ui green basic button mini icon defaut" href="/new_contingency/'.$f->id. '"><i class="icon plus"></i> Crear Cont.</a>';
                }
            } else {
                if ($f->contingency_id != null) {
                    //Ver contingencia ya existente
                    $contingency = '<a class="ui red basic button mini icon defaut " href="/contingencies/'.$f->contingency_id. '"><i class="icon exclamation triangle"></i> Ver Cont.</a>';
                } else {
                    $contingency = '';
                }
            }

        $buttons.='<a class="ui mini icon defaut button " href="/documents/'.$f->id.'/edit_comments"  title="Comentar y/o Asignar a Mantencion" style="float:left;"><i class="icon blue comment"></i><i class="plus left icon"></i><i class="green calendar icon"></i></a>';
        
        
            

        }  
        if($f->path != null){
            $documetx = '<a href="/docs/reports/'.$f->path.'"><i class="large download icon"></i></a>';
            if($f->version != null && $f->version != 1){
                $documentx = '<a href="/docs/reports/'.$f->path.'">'.$f->station->name.' '.$f->code.' '.$f->label.' v'.$f->version.'</a>';
            }else{
                $documentx = '<a href="/docs/reports/'.$f->path.'">'.$f->station->name.' '.$f->code.' '.$f->label.'</a>';
            }
        }else{
            $documentx = '-';
        }

        $maintenances = '';
            if ($f->maintenances->count() <> 0){
                foreach ($f->maintenances as $maintenance){
                    $maintenances = $maintenances.'<i class="calendar icon" title="Fecha Ejecucion"></i>'.$maintenance->execution_date.'<br><i class="settings icon" title="Actividad"></i>'.$maintenance->activity->name.'<br>
                    <span>'.$maintenance->pivot->check_observation.'</span><hr>';
                }
            }
            else{
                $maintenances = 'Sin Asignar';
            }
        
        $data[] =[
            'date' =>'<small>'.$f->created_at.'<hr>'.$f->updated_at.'</small>',
            'period' =>'<small>'.$f->period != null ?  $f->period->description : '-'.'</small>',
            'code' => '<small>'.$f->code.'</small>',
            'version' =>'<small>'.$f->version.'</small>',
            'documents' => '<small>'.$documentx.'</small>',
            'station' => '<small>'.$f->station != null ? $f->station->name : 'sin Estacion'.'</small>',
            'maintenances' => '<small>'.$maintenances.'</small>',
            'mma_comment' => '<small>'.$f->mma_comment.'</small>',
            'company_comment' => '<small>'.$f->company_comment.'</small>',
            'another_comment' => '<small>'.$f->another_comment.'</small>',
            'contingency' =>  $contingency,
            'actions' =>  $buttons
        ];
    }

return $data;
});

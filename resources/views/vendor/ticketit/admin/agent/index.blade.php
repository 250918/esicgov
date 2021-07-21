@extends('ticketit::layouts.master')

@section('page', trans('ticketit::admin.agent-index-title'))

@section('ticketit_header')
{!! link_to_route(
    $setting->grab('admin_route').'.agent.create',
    trans('ticketit::admin.btn-create-new-agent'), null,
    ['class' => 'btn btn-primary'])
!!}
@stop

@section('ticketit_content_parent_class', 'p-0')

@section('ticketit_content')
    @if ($agents->isEmpty())
        <h3 class="text-center">{{ trans('ticketit::admin.agent-index-no-agents') }}
            {!! link_to_route($setting->grab('admin_route').'.agent.create', trans('ticketit::admin.agent-index-create-new')) !!}
        </h3>
    @else
        <div id="message"></div>
        <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>{{ trans('ticketit::admin.table-id') }}</th>
                    <th>{{ trans('ticketit::admin.table-name') }}</th>
                    <th>{{ trans('ticketit::admin.table-categories') }}</th>
                    <th>{{ trans('ticketit::admin.table-join-category') }}</th>
                    <th>{{ trans('ticketit::admin.table-remove-agent') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($agents as $agent)
                <tr>
                    <td>
                        {{ $agent->id }}
                    </td>
                    <td>
                        {{ $agent->name }}
                    </td>
                    <td style="width:30%">
                    <div class="col">
                        <div class="row">
                            @foreach($agent->categories as $category)
                            <span class="col-md-12 card mb-2" style="color: {{ $category->color }}">
                                {{  $category->name }}
                            </span>
                        @endforeach
                        </div>
                    </div>

                    </td>
                    <td>
                        {!! CollectiveForm::open([
                                        'method' => 'PATCH',
                                        'route' => [
                                                    $setting->grab('admin_route').'.agent.update',
                                                    $agent->id
                                                    ],
                                        ]) !!}
                        @foreach(\Kordy\Ticketit\Models\Category::all() as $agent_cat)
                            <div class="form-check">
                                <input name="agent_cats[]"
                                   type="checkbox"
                                   class="form-check-input"
                                   value="{{ $agent_cat->id }}"
                                   {!! ($agent_cat->agents()->where("id", $agent->id)->count() > 0) ? "checked" : ""  !!}
                                   >
                                <label class="form-check-label" for="defaultCheck1">
                                   {{ $agent_cat->name }}
                                </label>
                            </div>


                        @endforeach
                        {!! CollectiveForm::submit(trans('ticketit::admin.btn-join'), ['class' => 'btn btn-info btn-sm']) !!}
                        {!! CollectiveForm::close() !!}
                    </td>
                    <td>
                        {!! CollectiveForm::open([
                        'method' => 'DELETE',
                        'route' => [
                                    $setting->grab('admin_route').'.agent.destroy',
                                    $agent->id
                                    ],
                        'id' => "delete-$agent->id"
                        ]) !!}
                        {!! CollectiveForm::submit(trans('ticketit::admin.btn-remove'), ['class' => 'btn btn-danger']) !!}
                        {!! CollectiveForm::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
@stop

    <div class="fix searchform floatright">
        {!! Form::open(['route' => 'search', 'class' => 'form-inline']) !!}
            <input type="text" name="query" class="form-control" style="width: 50%;" autofocus="true" value=""/>
            <input type="submit" class="btn btn-default submit" value="Search"/>
        {!! Form::close() !!}
    </div>
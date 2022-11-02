@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">

                <div class="card-body reset-form">
                    <form method="post" action="{{ route('holiday.add') }}" id="holidaysform" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Leave Type</label>
                                    <select name="leave_type" class="form-control" id="leave_type">
                                        <option selected disabled="false">Select Leave Type</option>
                                        <option value="1">Days Leave</option>
                                        <option value="2">Short Leave</option>
                                    </select>
                                    @error('leave_type')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row" id="short_leave">
                            <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputName">Start Date</label>
                                            <input type="date" id="start_date" class="form-control" value=""
                                                name="day_start_date" min="<?php echo date('Y-m-d'); ?>">
                                            @error('day_start_date')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputName">Start Time</label>
                                            <input type="time" id="start_time" class="form-control" value=""
                                                name="start_time">
                                            @error('start_time')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputName">End Time</label>
                                            <input type="time" id="end_time" class="form-control" value=""
                                                name="end_time">
                                            @error('end_time')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                            </div>
                        </div>

                        <div class="row" id="day_leave">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Start Date</label>
                                    <input type="date" id="start_date" class="form-control" value=""
                                        name="start_date" min="<?php echo date('Y-m-d'); ?>">
                                    @error('start_date')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">End Date</label>
                                    <input type="date" id="end_date" class="form-control" value="" name="end_date"
                                        min="<?php echo date('Y-m-d'); ?>">
                                    @error('end_date')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputName">Reason</label>
                                    <textarea id="reason" class="form-control" name="reason"></textarea>
                                    @error('reason')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Apply</button>
                                </div>
                            </div>
                        </div>

                </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#day_leave').hide();
            $('#short_leave').hide();

            $('#leave_type').change(function(){
                var leave_type = $('#leave_type').val();
                if(leave_type == 1){
                    $('#day_leave').show();
                    $('#short_leave').hide();
                }
                if(leave_type == 2){
                    $('#day_leave').hide();
                    $('#short_leave').show();
                }
            });
        });
    </script>
@endsection

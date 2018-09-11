@extend('dboardcontainer')

@section('title', 'Add Subject')

@section('content')
<section id="main-content" style="margin-bottom: 400px; padding-top: 15px;">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        Subject List
                    </header>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Add Extra Subject</strong>
                    </header>
                    <div class="panel-body">
                        <form action="subject-add" method="POST" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="subnme">Subject Name</label>
                                <input type="text" name="subnme" class="form-control" id="subnme" placeholder="Extra Subject Name">
                            </div>
                            <div class="form-group">
                                <label for="subcde">Subject Name</label>
                                <input type="text" name="subcde" class="form-control" id="subcde" placeholder="Extra Subject Code">
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection
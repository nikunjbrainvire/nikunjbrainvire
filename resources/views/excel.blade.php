<table>
    <thead>
    <tr>
        <th>Row No.</th>
        <th>Username</th>
        <th>Book Name</th>
        <th>Book Category</th>
        <th>Book Borrowed</th>
        <th>Book RetuenDate</th>
    </tr>
    </thead>
    <tbody>
        dd($errors);
    @foreach($errors as $error)
        <tr>
            <td>{{ $error->id}}</td>
            <td>{{ $error->name}}</td>
            <td>{{ $error->book_name}}</td>
            <td>{{ $error->book_Category}}</td>
            <td>{{ $error->created_at}}</td>
            <td>{{ $error->returnbook_date}}</td>
            {{-- <td>{{ $error[3]}}</td> --}}
        </tr>
    @endforeach
    </tbody>


	{{-- <link href="http://127.0.0.1/demo/example-app/resources/css/bootstrap.min.css" rel="stylesheet"> --}}
	{{-- <link href="http://127.0.0.1/demo/example-app/resources/css/datepicker3.css" rel="stylesheet"> --}}
	{{-- <link href="http://127.0.0.1/demo/example-app/resources/css/styles.css" rel="stylesheet"> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous"> --}}

<style>
    .center {
  margin-left: auto;
  margin-right: auto;
}
</style>

<center>


<h2>Your Book History {{ Session::get('username') }}</h2><br>

  @php $r = 0; @endphp
  <table border="1" class="center">

    <tr>
        <td></td>
        <td>Book Name</td>
        {{-- <td></td> --}}
        <td>Price</td>
        <td>Borrowed Date</td>
    </tr>
                        @foreach ($users as $datas)


                        <tr>
                            <td>
                                <img height="100" src="{{ 'http://127.0.0.1/demo/example-app/storage/app/'.$datas->book_image }}"></img>
                            </td>
                            <td>
                                <p style="font-size: 20px;color:black;">{{ $datas->book_name }}</p>

                            </td>
                            {{-- <td>
                                <p style="font-size: 15px;color:black;">Quantity :- 1</p>

                            </td> --}}
                            <td>
                                <p style="font-size: 15px;color:black;">{{ $datas->book_price }}</p>

                            </td>
                            <td>
                                <p style="font-size: 15px;color:black;">{{ $datas->updated_at }}</p>

                            </td>
                        </tr>



                                @php $r = $r+$datas->book_price @endphp

                        @endforeach
  </table>
</center>
                        {{-- <a href="/user/ordernow" style="float: right;margin:5px;font-size:20px;" class="btn btn-primary" type="submit">Order Now </a> --}}
                        {{-- <table class="table" border="1">


                                <tr>
                                    <td rowspan="3" colspan="3" style="width: 350px;">Thanks For Borrowed</td>
                                    <td style="text-align :center;" >Total:- </td>
                                    <td style="text-align :center;" >{{ $r }} </td>
                                </tr>

                                <tr>
                                    <td style="text-align :center;" >Tex:- </td>
                                    <td style="text-align :center;" >0 </td>
                                </tr>

                                <tr>
                                    <td style="text-align :center;" >Total Amount:- </td>
                                    <td style="text-align :center;" >{{ $r }} </td>
                                </tr>

                        </table> --}}


<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        div#pagination ul li {
            display: inline;
        }
    </style>
</head>
<body>

<h2>Phone numbers</h2>

<form action="{{ route('customer-phones') }}">
    <div class="row form-group" style="margin-bottom: 20px; display: flex">

        <div class="col" style="margin-right: 20px;">
            <label for="country">Country</label>
            <select id="country" name="country" class="form-control">
                <option @if(is_null($country)) selected @endif value="{{null}}">All</option>
                @foreach($countryArr as $key => $countryName)
                    <option @if($countryName === $country) selected
                            @endif value="{{$countryName}}">{{$countryName}}</option>
                @endforeach
            </select>
        </div>

        <div class="col" style="margin-right: 20px;">
            <label for="is_valid_phone">State</label>
            <select id="is_valid_phone" name="is_valid_phone" class="form-control">
                <option @if(is_null($isValidPhoneNumber)) selected @endif value="{{null}}">All</option>
                <option @if(intval($isValidPhoneNumber) === 1) selected @endif value="1">Valid phone
                    numbers
                </option>
                <option @if(!is_null($isValidPhoneNumber) && intval($isValidPhoneNumber) === 0) selected
                        @endif value="0">Invalid phone numbers
                </option>
            </select>
        </div>

        <div class="col">
            <input class="btn btn-success" type="submit" value="Go">
        </div>

    </div>
</form>
<table>
    <tr>
        <th>Country</th>
        <th>State</th>
        <th>Country code</th>
        <th>Phone num</th>
    </tr>
    <tbody>
    @foreach ($customerPhones as $customerPhone)

        <tr>
            <td>{{$customerPhone['country']}}</td>
            <td>{{$customerPhone['is_valid_phone'] ? 'OK' : 'NOK'}}</td>
            <td>+{{$customerPhone['country_code']}}</td>
            <td>{{$customerPhone['phone']}}</td>
        </tr>

    @endforeach

    </tbody>
</table>

<div id="pagination" style="text-align:center">{{$customerPhones->appends(request()->except(['page']))->links()}}</div>

</body>
</html>

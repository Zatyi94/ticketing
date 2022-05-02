@extends('admin.layout')

@section('content')

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <input type="submit" value="Kilépés">
    </form>
    <hr>
    <h2>Kategóriák</h2>
    <table>
        <tr>
            <td>Név</td>
            <td>Szín</td>
            <td>Aktív</td>
            <td></td>
        </tr>
        @forelse($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>{{$category->bcolor}}</td>
                <td>{{$category->active == 1 ? "Aktív" : "Inaktív"}}</td>
                <td>
                    <form action="{{ route('admin.categories.destroy', ["id"=>$category->id]) }}" method="post">
                        @csrf
                        <input type="submit" value="Törlés">
                    </form>

                    <form action="{{ $category->active == 1 ? route('admin.categories.disable') : route('admin.categories.enable') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$category->id}}"/>
                        <input type="submit" value="{{ $category->active == 1 ? "Kikapcsolás" : "Bekapcsolás" }}"/>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Nincsenek kategóriák a rendszerben</td>
            </tr>
        @endforelse
    </table>
    <hr>
    <h2>Kategória létrehozása</h2>
    <form action="{{route('admin.categories.store')}}" method="post">
        @csrf
        Név
        <input type="text" name="name">
        <br>
        Szín
        <select name="bcolor">
            <option value="primary">Kék</option>
            <option value="secondary">Szürke</option>
            <option value="warning">Sárga</option>
            <option value="danger">Piros</option>
            <option value="success">Zöld</option>
            <option value="info">Világoskék</option>
        </select>
        <br>
        <input type="submit" value="Létrehozás">
    </form>
@endsection

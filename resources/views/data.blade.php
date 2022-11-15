<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NAMA</th>
            <th scope="col">EMAIL</th>
            <th scope="col">NO TELPON</th>
        </tr>
    </thead>
    <tbody>
        
        @if(count($data) > 0)
            <?php $no=1; ?>
            @foreach($data as $v)
            <tr>
                <td>{{ $v->id }}</td>
                <td>{{ $v->name }}</td>
                <td>{{ $v->email }}</td>
                <td>{{ $v->no_telp }}</td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center">Data tidak ada...</td>
            </tr>
        @endif
    </tbody>
</table>
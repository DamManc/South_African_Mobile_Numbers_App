
@if($tables != null)
    @foreach($tables as $k => $table)
        <div class="sect-table-int">
            <div class="sect-table-title">
                <h2>Tabella dei Records @if($k === 0) Corretti : {{count($table)}} @elseif($k === 1) Revisionati : {{count($table)}}@else Incorretti : {{count($table)}} @endif</h2>
            </div>
            <div class="sect-table-cont">
                <table>
                    <thead>
                    <tr>
                        <th class="id"><span>ID</span></th>
                        <th class="phone"><span>Numero di Telefono</span></th>
                        @if($k === 1 or $k === 2)<th class="error"><span>@if($k === 1)Revisione @else Errore @endif</span></th>@endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                    <tr>
                        <td><span>{{array_values($row)[0]}}</span></td>
                        <td>{{array_values($row)[1]}}</td>
                        @if(isset(array_values($row)[2]))<td>{{array_values($row)[2]}}</td>@endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
@else
    <div>
        <p>non sono stati ancora caricati dei dati</p>
    </div>
@endif

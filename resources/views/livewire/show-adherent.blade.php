<table class="w-full table-fixed admin-stripped-table">
            <thead>
                <tr class="w-full">
                    <th class=" ">Id</th>
                    <th class="">Prénom</th>
                    <th class="">Nom</th>
                    <th class="">Commune</th>
                   
                    <th class="">Email</th>
                    <th class="">Téléphone</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($adherents as $adherent)
                    <tr>
                        <td>{{ $adherent->id }}</td>
                        <td>{{ $adherent->firstname }}</td>
                        <td>{{ $adherent->familyname }}</td>
                        <td>{{ $adherent->city }}</td>
                        <td>{{ $adherent->email }}</td>
                        <td>{{ $adherent->phone }}</td>
                      
                    </tr>
                @endforeach
            </tbody>
        </table>,
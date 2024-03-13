<x-layouts>
    <div class="container">
        <section>
            <h3>{{auth()->user()->name}}</h3>
            <ul>
                <li><h3>{{auth()->user()->email}}</h3></li>
                <li><h3>{{auth()->user()->phone}}</h3></li>
            </ul>
        </section>
        <section>
            <div>
                <img src="{{asset('storage/'.auth()->user()->image )}}" class="rounded float-start" alt="..." width="100px" height="100px">
            </div>
        </section>
    </div>
</x-layouts>

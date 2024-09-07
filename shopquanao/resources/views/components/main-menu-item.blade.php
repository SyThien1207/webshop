
@if (count($listmenu)==0)
<li><a href="{{$menu_item->link}}">{{$menu_item->name}}</a></li>
@else
<li>
  <a href="#"> {{$menu_item->name}}</a>
  <ul class="custom-scrollbar">
    @foreach ($listmenu as $item)
    <li><a href="{{$item->link}}">{{$item->name}}</a></li>
    @endforeach
  </ul>
</li>
@endif
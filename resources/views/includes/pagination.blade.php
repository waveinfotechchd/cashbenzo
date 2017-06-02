@if ($paginator->lastPage() > 1)
<ul class="pagination pagination-lg">
    <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
        <a href="{{ $paginator->url(1) }}"><i class="fa fa-angle-left"></i></a>
    </li>
	<?php
		if($paginator->currentPage()>4){$lesspage=$paginator->currentPage()-3;}else{$lesspage=1;}
		if($paginator->currentPage()<$paginator->lastPage()-3){$pluspage=$paginator->currentPage()+3;}else{$pluspage=$paginator->lastPage();}
		//echo "<pre>";print_r($paginator);echo "</pre>";
	?>
    @for ($i=$lesspage; $i <= $pluspage; $i++)
        <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
            <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" ><i class="fa fa-angle-right"></i></a>
    </li>
</ul>
@endif
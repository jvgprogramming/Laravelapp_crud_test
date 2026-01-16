@if ($paginator->hasPages())
<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
    <div style="color: #666; font-size: 0.95rem;">
        Showing <strong>{{ $paginator->firstItem() }}</strong> to <strong>{{ $paginator->lastItem() }}</strong> of <strong>{{ $paginator->total() }}</strong> records
    </div>
    
    <div style="display: flex; gap: 0.5rem; align-items: center;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span style="padding: 0.5rem 1rem; background: #e9ecef; color: #999; border-radius: 4px; cursor: not-allowed;">← Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="padding: 0.5rem 1rem; background: #667eea; color: white; border-radius: 4px; text-decoration: none; cursor: pointer; transition: 0.3s;">← Previous</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span style="padding: 0.5rem 0.75rem; color: #999;">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="padding: 0.5rem 1rem; background: #667eea; color: white; border-radius: 4px; font-weight: bold;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="padding: 0.5rem 1rem; background: white; color: #667eea; border: 1px solid #667eea; border-radius: 4px; text-decoration: none; cursor: pointer; transition: 0.3s;" onmouseover="this.style.background='#667eea'; this.style.color='white';" onmouseout="this.style.background='white'; this.style.color='#667eea';">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="padding: 0.5rem 1rem; background: #667eea; color: white; border-radius: 4px; text-decoration: none; cursor: pointer; transition: 0.3s;">Next →</a>
        @else
            <span style="padding: 0.5rem 1rem; background: #e9ecef; color: #999; border-radius: 4px; cursor: not-allowed;">Next →</span>
        @endif
    </div>
</div>
@endif

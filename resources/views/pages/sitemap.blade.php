<?= '<'.'?'.'xml version="1.0" encoding="UTF-8"?>'."\n" ?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('home') }}</loc>
    </url>
    @foreach($pages as $page)
        @if($page->path !== route('home'))
            <url>
                <loc>{{ $page->path }}</loc>
            </url>
        @endif
    @endforeach
    @foreach($articles as $service)
        @if($service->path !== route('home'))
            <url>
                <loc>{{ $service->path }}</loc>
            </url>
        @endif
    @endforeach
    @foreach($categories as $service)
        @if($service->path !== route('home'))
            <url>
                <loc>{{ $service->path }}</loc>
            </url>
        @endif
    @endforeach
    @foreach($projects as $service)
        @if($service->path !== route('home'))
            <url>
                <loc>{{ $service->path }}</loc>
            </url>
        @endif
    @endforeach
</urlset>

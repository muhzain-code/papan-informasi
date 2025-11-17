<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papan Informasi Digital - Fakultas Teknik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'ticker': 'ticker 60s linear infinite',
                    },
                    keyframes: {
                        'ticker': {
                            '0%': {
                                transform: 'translateX(100vw)'
                            },
                            '100%': {
                                transform: 'translateX(-100%)'
                            },
                        },
                    }
                }
            }
        };
    </script>

    <style>
        body {
            font-family: 'Inter', 'sans-serif';
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            display: grid;
            grid-template-rows: auto 1fr auto;
            height: 100vh;
            max-height: 100vh;
        }

        main {
            display: grid;
            grid-template-columns: 40% 60%;
            overflow: hidden;
        }

        aside {
            display: grid;
            grid-template-rows: 14.0625vw 1fr;
            overflow: hidden;
        }

        .slideshow-container {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
    </style>

</head>

<body class="bg-slate-900 text-white overflow-hidden">

    <header class="flex items-center justify-between p-2 bg-slate-800 border-b-2 border-amber-400 z-10">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('img/unuja.png') }}" alt="Logo Fakultas" class="w-9 h-9">
            <div>
                <h1 class="text-xl font-bold text-amber-400">FAKULTAS TEKNIK</h1>
                <p class="text-sm text-slate-300">UNIVERSITAS NURUL JADID</p>
            </div>
        </div>
        <div class="text-right">
            <div id="clock" class="text-2xl font-bold text-white"></div>
            <div id="date" class="text-sm text-slate-300"></div>
        </div>
    </header>

    <main class="h-full">

        <section class="h-full relative bg-gradient-to-br from-slate-800 to-slate-900 border-r-2 border-slate-700">
            <div id="news-slideshow-container" class="slideshow-container">

                @forelse($news as $newsItem)
                    <div class="slide news-slide flex flex-col overflow-hidden">

                        <img src="{{ $newsItem->thumbnail ? asset('storage/' . $newsItem->thumbnail) : 'https://placehold.co/1000x800/047857/ffffff?text=Berita' }}"
                            alt="{{ $newsItem->title }}" class="w-full h-3/4 object-cover"
                            onerror="this.src='https://placehold.co/1000x800/777/ffffff?text=Image+Error'">

                        <div class="w-full h-1/4 p-4 bg-slate-800 flex flex-col justify-start">
                            <p class="text-sm font-medium text-amber-400">
                                {{ \Illuminate\Support\Str::upper($newsItem->published_at->format('d F Y')) }}</p>

                            <h2 class="text-2xl font-bold text-white mt-1 line-clamp-3">{{ $newsItem->title }}</h2>
                        </div>
                    </div>
                @empty
                    <div class="slide news-slide flex flex-col overflow-hidden" style="opacity: 1;">
                        <img src="https://placehold.co/1000x800/777/ffffff?text=Tidak+Ada+Berita" alt="Tidak Ada Berita"
                            class="w-full h-3/4 object-cover">
                        <div class="w-full h-1/4 p-4 bg-slate-800 flex flex-col justify-start">
                            <h2 class="text-2xl font-bold text-white mt-1">Tidak Ada Berita</h2>
                            <p class="text-base text-slate-300 mt-1">Belum ada berita terbaru yang dipublikasikan.</p>
                        </div>
                    </div>
                @endforelse

            </div>
        </section>

        <aside class="h-full">

            <div class="h-full w-full flex">

                <div
                    class="h-full bg-gradient-to-br from-slate-800 to-slate-700 flex flex-col overflow-hidden border-r-2 border-slate-700 flex-1">

                    <div id="info-slideshow-container" class="slideshow-container flex-grow min-h-0">

                        @forelse($infos as $info)
                            <div class="slide info-slide p-3 flex flex-col h-full justify-center">
                                <h3 class="text-2xl font-semibold text-amber-400 mt-1 text-center">
                                    {{ $info->title }}
                                </h3>
                                <p class="text-base text-slate-300 text-center leading-relaxed mt-1">
                                    {{ $info->message }}
                                </p>
                            </div>
                        @empty
                            <div class="slide info-slide p-3 flex flex-col h-full justify-center" style="opacity: 1;">
                                <h3 class="text-2xl font-semibold text-amber-400 text-center">
                                    Tidak Ada Informasi
                                </h3>
                                <p class="text-base text-slate-300 text-center leading-relaxed mt-1">
                                    Belum ada informasi penting saat ini.
                                </p>
                            </div>
                        @endforelse

                    </div>
                </div>

                <div id="video-player-container" class="h-full bg-black relative" style="width: 25vw; flex-shrink: 0;">
                </div>

            </div>

            <div
                class="h-full w-full bg-gradient-to-br from-slate-900 to-slate-800 flex flex-col overflow-hidden border-t-2 border-slate-700">
                <div class="p-3 border-b-2 border-amber-400 flex-shrink-0">
                    <h2 class="text-xl font-bold text-amber-400">JADWAL KULIAH</h2>
                </div>

                <div id="jadwal-slideshow-container" class="slideshow-container flex-grow min-h-0">

                    @forelse($schedules->chunk(6) as $scheduleChunk)
                        <div class="slide jadwal-slide p-1 h-full">

                            <div class="grid grid-cols-3 grid-rows-2 gap-1 h-full">

                                @foreach ($scheduleChunk as $schedule)
                                    <div
                                        class="p-2 bg-slate-700/50 backdrop-blur-sm rounded-lg flex flex-col border border-slate-600">
                                        <p class="text-sm font-medium text-amber-400">
                                            {{ $schedule->start_time ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i') : '-' }}
                                            @if ($schedule->end_time)
                                                -
                                                {{ $schedule->end_time ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i') : '-' }}
                                            @endif
                                        </p>
                                        <h3 class="text-base font-bold text-white mt-1 flex-grow">
                                            {{ $schedule->course->name ?? ($schedule->course->name ?? 'N/A') }}
                                        </h3>
                                        <p class="text-sm text-slate-300">
                                            {{ $schedule->lecturer->name ?? 'Dosen tidak diatur' }}
                                        </p>
                                        <p class="text-sm text-slate-300 font-medium">
                                            {{ $schedule->room->name ?? ($schedule->room->name ?? 'N:A') }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="slide jadwal-slide p-1 flex items-center justify-center" style="opacity: 1;">
                            <div class="p-4 bg-slate-700/50 rounded-lg text-center">
                                <h3 class="text-lg font-bold text-white">Tidak Ada Jadwal Kuliah</h3>
                                <p class="text-sm text-slate-300">Tidak ada jadwal kuliah untuk hari ini.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </aside>

    </main>

    <footer class="p-2 bg-slate-800 border-t-2 border-amber-400 overflow-hidden whitespace-nowrap z-10">
        @if ($announcements->isEmpty())
            <div class="inline-block">
                <span class="text-lg mx-12 text-slate-200">
                    Tidak ada pengumuman saat ini.
                </span>
            </div>
        @else
            <div class="inline-block animate-ticker">
                @for ($i = 0; $i < 2; $i++)
                    @foreach ($announcements as $announcement)
                        <span class="text-lg mx-12 text-slate-200">
                            {{ $announcement->title }}
                        </span>
                    @endforeach
                @endfor
            </div>
        @endif
    </footer>

    <script src="https://www.youtube.com/iframe_api"></script>

    @php
        $jsVideoData = $videos
            ->map(function ($video) {
                if ($video->source_type == 'file' && $video->video_path) {
                    return [
                        'type' => 'file',
                        'url' => asset('storage/' . $video->video_path),
                    ];
                } elseif ($video->source_type == 'youtube' && $video->video_url) {
                    $url = rtrim($video->video_url, '/');
                    $videoId = \Illuminate\Support\Str::afterLast($url, '/');
                    $videoId = explode('?', $videoId)[0];
                    return [
                        'type' => 'youtube',
                        'url' => $videoId,
                    ];
                }
                return null;
            })
            ->whereNotNull()
            ->values();
    @endphp

    <script>
        const videoData = @json($jsVideoData);
    </script>

    <script>
        function updateTime() {
            const clockEl = document.getElementById('clock');
            const dateEl = document.getElementById('date');

            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
                timeZone: 'Asia/Jakarta'
            };

            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                timeZone: 'Asia/Jakarta'
            };

            const now = new Date();

            if (clockEl) {
                clockEl.textContent = now.toLocaleTimeString('id-ID', timeOptions).replace(/\./g, ':');
            }
            if (dateEl) {
                dateEl.textContent = now.toLocaleDateString('id-ID', dateOptions);
            }
        }

        updateTime();
        setInterval(updateTime, 1000);


        let currentVideoIndex = 0;
        let ytPlayer = null;
        let playerContainer = null;

        function playNextVideo() {
            console.log("Playing next video...");
            if (videoData.length > 0) {
                currentVideoIndex = (currentVideoIndex + 1) % videoData.length;
                playCurrentVideo();
            }
        }

        function onYTStateChange(event) {
            if (event.data === YT.PlayerState.ENDED) {
                console.log("YT Video Ended.");
                playNextVideo();
            }
        }

        function playCurrentVideo() {
            if (!playerContainer) {
                playerContainer = document.getElementById("video-player-container");
                if (!playerContainer) {
                    console.error("Video player container not found!");
                    return;
                }
            }

            if (ytPlayer) {
                ytPlayer.destroy();
                ytPlayer = null;
            }
            playerContainer.innerHTML = "";

            if (!videoData || videoData.length === 0) {
                playerContainer.innerHTML = `<div class="w-full h-full flex items-center justify-center bg-slate-900">
                    <img src="https://placehold.co/800x800/1e293b/475569?text=Video+Tidak+Tersedia"
                        alt="Video Tidak Tersedia" class="w-full h-full object-cover opacity-50">
                    <p class="absolute text-slate-300">Tidak ada video aktif.</p>
                </div>`;
                return;
            }

            const video = videoData[currentVideoIndex];
            if (!video) {
                console.error(`Data video tidak valid di index ${currentVideoIndex}`);
                playNextVideo();
                return;
            }

            console.log(`Playing video ${currentVideoIndex}: ${video.type} - ${video.url}`);

            if (video.type === 'youtube') {
                const ytPlaceholder = document.createElement('div');
                ytPlaceholder.id = 'yt-player-dynamic';
                ytPlaceholder.className = 'w-full h-full';
                playerContainer.appendChild(ytPlaceholder);

                ytPlayer = new YT.Player('yt-player-dynamic', {
                    videoId: video.url,
                    width: '100%',
                    height: '100%',
                    playerVars: {
                        'controls': 1,
                        'showinfo': 0,
                        'rel': 0,
                        'origin': window.location.origin,
                        'enablejsapi': 1
                    },
                    events: {
                        'onReady': (event) => {
                            console.log('YT Player is Ready. Muting and Playing.');
                            event.target.mute();
                            event.target.playVideo();
                        },
                        'onStateChange': onYTStateChange,
                        'onError': (e) => {
                            console.error('YT Player Error:', e.data);
                            playNextVideo();
                        }
                    }
                });

            } else if (video.type === 'file') {
                const videoEl = document.createElement('video');
                videoEl.className = 'w-full h-full object-cover';
                videoEl.src = video.url;
                videoEl.controls = true;
                videoEl.muted = true;
                videoEl.playsInline = true;

                videoEl.onended = () => {
                    console.log("File Video Ended.");
                    playNextVideo();
                };

                videoEl.onerror = () => {
                    console.error('File Video Error: Gagal memuat', video.url);
                    playNextVideo();
                }

                playerContainer.appendChild(videoEl);

                const playPromise = videoEl.play();
                if (playPromise !== undefined) {
                    playPromise.catch(e => {
                        console.warn("Autoplay file video ditolak, video akan diam:", e);
                    });
                }
            }
        }


        let domReady = false;
        let ytApiReady = false;
        let videoPlayerStarted = false;

        const hasYouTubeVideo = videoData.some(video => video.type === 'youtube');

        function startVideoPlayerIfReady() {
            if (videoPlayerStarted) {
                return;
            }

            if (!videoData || videoData.length === 0) {
                if (domReady) {
                    console.log("DOM ready, no videos found. Showing empty state.");
                    videoPlayerStarted = true;
                    playCurrentVideo();
                }
                return;
            }

            if (!hasYouTubeVideo) {
                if (domReady) {
                    console.log("DOM ready. Only file videos found. Starting player.");
                    videoPlayerStarted = true;
                    playCurrentVideo();
                }
            } else {
                if (domReady && ytApiReady) {
                    console.log("DOM and YT API ready. YouTube video(s) present. Starting player.");
                    videoPlayerStarted = true;
                    playCurrentVideo();
                } else {
                    console.log(`Waiting for both... DOM: ${domReady}, YT API: ${ytApiReady}`);
                }
            }
        }

        function onYouTubeIframeAPIReady() {
            console.log("YouTube API is ready.");
            ytApiReady = true;
            startVideoPlayerIfReady();
        }

        document.addEventListener('DOMContentLoaded', () => {
            console.log("DOM is ready. Setting up standard slideshows.");
            domReady = true;

            function setupJsSlideshow(containerId, slideClass, durationInSeconds) {
                const container = document.getElementById(containerId);
                if (!container) return;

                const slides = container.querySelectorAll(slideClass);

                if (slides.length <= 1) {
                    if (slides.length === 1) {
                        slides[0].style.opacity = 1;
                    }
                    return;
                }

                let currentSlideIndex = 0;
                slides[currentSlideIndex].style.opacity = 1;

                setInterval(() => {
                    slides[currentSlideIndex].style.opacity = 0;
                    currentSlideIndex = (currentSlideIndex + 1) % slides.length;
                    slides[currentSlideIndex].style.opacity = 1;
                }, durationInSeconds * 1000);
            }

            const animationDurations = {
                news: 13, // 13s
                info: 11, // 11s
                jadwal: 12, // 12s
            };

            setupJsSlideshow('news-slideshow-container', '.news-slide', animationDurations.news);
            setupJsSlideshow('info-slideshow-container', '.info-slide', animationDurations.info);
            setupJsSlideshow('jadwal-slideshow-container', '.jadwal-slide', animationDurations.jadwal);

            startVideoPlayerIfReady();
        });
    </script>

</body>

</html>

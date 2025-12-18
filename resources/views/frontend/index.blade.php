<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Papan Informasi Digital Fakultas Teknik">
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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: clamp(12px, 1vmin, 20px);
            overflow: hidden;
        }

        body {
            font-family: 'Inter', 'sans-serif';
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            display: grid;
            grid-template-rows: auto 1fr auto;
            height: 100vh;
            max-height: 100vh;
            overflow: hidden;
            width: 100vw;
            max-width: 100vw;
        }

        /* Header with responsive sizing */
        header {
            height: clamp(60px, 8vh, 100px);
            min-height: 60px;
        }

        header img {
            width: clamp(40px, 5vh, 70px) !important;
            height: clamp(40px, 5vh, 70px) !important;
        }

        header h1 {
            font-size: clamp(1rem, 2.5vmin, 2rem) !important;
        }

        header p {
            font-size: clamp(0.7rem, 1.5vmin, 1.2rem) !important;
        }

        #clock {
            font-size: clamp(1.2rem, 3vmin, 2.5rem) !important;
        }

        #date {
            font-size: clamp(0.7rem, 1.5vmin, 1.2rem) !important;
        }

        /* Footer with responsive sizing */
        footer {
            height: clamp(40px, 6vh, 70px);
            min-height: 40px;
        }

        footer span {
            font-size: clamp(0.9rem, 2vmin, 1.5rem) !important;
        }

        main {
            display: grid;
            grid-template-columns: 35% 40% 25%;
            gap: 0;
            overflow: hidden;
            height: 100%;
            width: 100%;
        }

        /* Responsive section headers */
        .section-header {
            padding: clamp(0.5rem, 1.5vh, 1.5rem) clamp(0.75rem, 2vw, 2rem);
        }

        .section-header h2 {
            font-size: clamp(0.9rem, 2.2vmin, 1.8rem) !important;
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
            transition: opacity 0.6s ease-in-out;
        }

        /* News section responsive text */
        .news-date {
            font-size: clamp(0.7rem, 1.5vmin, 1.1rem) !important;
            margin-bottom: clamp(0.3rem, 0.8vh, 0.8rem);
        }

        .news-title {
            font-size: clamp(1rem, 2.5vmin, 2rem) !important;
            line-height: 1.2 !important;
        }

        .news-content-box {
            padding: clamp(1rem, 2vh, 2rem) clamp(1rem, 2vw, 2rem);
        }

        .news-info-link {
            font-size: clamp(0.7rem, 1.4vmin, 1rem) !important;
            margin-top: clamp(0.3rem, 0.6vh, 0.6rem);
        }

        /* Info section responsive text */
        .info-title {
            font-size: clamp(1.2rem, 3vmin, 2.5rem) !important;
            margin-bottom: clamp(0.5rem, 1.5vh, 1.5rem);
        }

        .info-message {
            font-size: clamp(0.9rem, 2vmin, 1.5rem) !important;
            line-height: 1.5 !important;
        }

        .info-content-box {
            padding: clamp(1rem, 2vh, 2rem) clamp(1rem, 3vw, 2.5rem);
        }

        /* Schedule cards - FIXED VISIBILITY */
        .schedule-grid {
            padding: clamp(0.5rem, 1.2vh, 0.9rem);
            gap: clamp(0.5rem, 1vh, 0.8rem) !important;
        }

        .schedule-card {
            padding: clamp(0.5rem, 1.2vh, 0.9rem) clamp(0.5rem, 1.2vw, 0.9rem);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: clamp(0.4rem, 0.8vmin, 0.8rem);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            text-align: left;
            gap: clamp(0.15rem, 0.4vh, 0.3rem);
            overflow: visible;
            min-height: 0;
        }

        .schedule-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
        }

        .schedule-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: clamp(0.3rem, 0.5vw, 0.5rem);
        }

        .schedule-time {
            font-size: clamp(0.7rem, 1.5vmin, 1.1rem) !important;
            line-height: 1.3;
            flex-shrink: 0;
        }

        .schedule-prodi {
            font-size: clamp(0.55rem, 1.1vmin, 0.8rem) !important;
            background: linear-gradient(135deg, #06b6d4, #0891b2);
            color: white;
            padding: clamp(0.1rem, 0.2vh, 0.15rem) clamp(0.3rem, 0.5vw, 0.4rem);
            border-radius: clamp(0.2rem, 0.4vmin, 0.3rem);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .schedule-course {
            font-size: clamp(0.75rem, 1.6vmin, 1.2rem) !important;
            line-height: 1.3 !important;
            word-break: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: calc(1.3em * 3);
            flex-shrink: 0;
        }

        .schedule-lecturer {
            font-size: clamp(0.65rem, 1.4vmin, 1rem) !important;
            line-height: 1.3;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
            flex-shrink: 0;
        }

        .schedule-room {
            font-size: clamp(0.7rem, 1.5vmin, 1.1rem) !important;
            line-height: 1.3;
            flex-shrink: 0;
        }

        /* Chat bubbles - NO CUTTING OR SINKING */
        #notification-wrapper {
            padding: clamp(0.4rem, 0.8vh, 0.6rem);
            height: 100%;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        #notification-container {
            display: flex;
            flex-direction: column;
            gap: clamp(0.25rem, 0.5vh, 0.4rem);
            flex: 1;
            overflow: hidden;
        }

        .chat-bubble {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            border-radius: clamp(0.5rem, 1vmin, 0.8rem);
            border-top-left-radius: clamp(0.1rem, 0.2vmin, 0.15rem);
            padding: clamp(0.4rem, 0.8vh, 0.6rem) clamp(0.5rem, 1vw, 0.8rem);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            border-left: clamp(2px, 0.3vw, 3px) solid #fbbf24;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 0;
            gap: clamp(0.1rem, 0.2vh, 0.15rem);
        }

        .chat-bubble .chat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: clamp(0.3rem, 0.6vw, 0.5rem);
        }

        .chat-bubble .chat-admin {
            color: #fbbf24;
            font-weight: 700;
            font-size: clamp(0.65rem, 1.3vmin, 0.9rem);
            line-height: 1.3;
            white-space: nowrap;
        }

        .chat-bubble .chat-datetime {
            font-size: clamp(0.55rem, 1vmin, 0.75rem);
            color: #94a3b8;
            line-height: 1.3;
            white-space: nowrap;
        }

        .chat-bubble .message {
            color: #e2e8f0;
            line-height: 1.4;
            font-size: clamp(0.65rem, 1.3vmin, 0.9rem);
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            word-break: break-word;
        }

        /* Info meta styling */
        .info-meta {
            margin-top: clamp(0.5rem, 1vh, 1rem);
        }

        .info-meta span {
            font-size: clamp(0.7rem, 1.3vmin, 1rem) !important;
        }

        /* Notification blink animation */
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .notification-blink {
            animation: blink 0.5s ease-in-out 2;
        }

        /* Video player full container - TRULY NO GAPS */
        .video-section {
            position: relative;
            overflow: hidden;
            background: #000;
            margin: 0;
            padding: 0;
            border-bottom: none !important;
        }

        #video-player-container {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100% !important;
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden;
            background: #000;
        }

        #video-player-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center center;
        }

        #video-player-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
            border: none;
        }

        #video-player-container .video-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #64748b;
            font-size: clamp(1rem, 2vmin, 1.5rem);
        }

        /* Ensure smooth rendering */
        * {
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        /* Responsive adjustments for different aspect ratios */
        @media screen and (max-aspect-ratio: 4/3) {
            main {
                grid-template-columns: 40% 35% 25%;
            }
        }

        @media screen and (min-aspect-ratio: 21/9) {
            main {
                grid-template-columns: 33% 42% 25%;
            }
        }

        @media screen and (max-width: 1024px) {
            main {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(3, 1fr);
            }
        }

        /* Ensure no content overflow */
        .overflow-hidden {
            overflow: hidden !important;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

</head>

<body class="bg-slate-900 text-white overflow-hidden">

    <header class="flex items-center justify-between px-6 py-3 bg-slate-800 border-b-4 border-amber-400 z-10">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('img/unuja.png') }}" alt="Logo Fakultas" class="w-14 h-14">
            <div>
                <h1 class="text-2xl font-black text-amber-400 tracking-wide">FAKULTAS TEKNIK</h1>
                <p class="text-base text-slate-300 font-medium">UNIVERSITAS NURUL JADID</p>
            </div>
        </div>
        <div class="text-right">
            <div id="clock" class="text-3xl font-black text-white tracking-wider"></div>
            <div id="date" class="text-base text-slate-300 font-medium"></div>
        </div>
    </header>

    <main class="h-full">

        <!-- Left Column: News Section (Full Height) -->
        <section class="h-full relative bg-gradient-to-br from-slate-800 to-slate-900 border-r-2 border-slate-700">
            <div id="news-slideshow-container" class="slideshow-container">

                @forelse($news as $newsItem)
                    <div class="slide news-slide flex flex-col overflow-hidden">

                        <img src="{{ $newsItem->thumbnail ? asset('storage/' . $newsItem->thumbnail) : 'https://placehold.co/1000x800/047857/ffffff?text=Berita' }}"
                            alt="{{ $newsItem->title }}" class="w-full h-[70%] object-cover"
                            onerror="this.src='https://placehold.co/1000x800/777/ffffff?text=Image+Error'">

                        <div class="w-full h-[30%] news-content-box bg-slate-800 flex flex-col justify-center">
                            <p class="news-date font-bold text-amber-400 uppercase tracking-wide">
                                {{ \Illuminate\Support\Str::upper($newsItem->published_at->format('d F Y')) }}</p>

                            <h2 class="news-title font-black text-white line-clamp-2">{{ $newsItem->title }}</h2>
                            
                            <p class="news-info-link text-slate-400 text-sm mt-2">
                                🌐 Informasi lebih lanjut di website <span class="text-amber-400 font-semibold">unuja.ac.id</span>
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="slide news-slide flex flex-col overflow-hidden" style="opacity: 1;">
                        <img src="https://placehold.co/1000x800/777/ffffff?text=Tidak+Ada+Berita" alt="Tidak Ada Berita"
                            class="w-full h-[70%] object-cover">
                        <div class="w-full h-[30%] news-content-box bg-slate-800 flex flex-col justify-center">
                            <h2 class="news-title font-black text-white mb-2">Tidak Ada Berita</h2>
                            <p class="info-message text-slate-300">Belum ada berita terbaru yang dipublikasikan.</p>
                            <p class="news-info-link text-slate-400 text-sm mt-2">
                                🌐 Informasi lebih lanjut di website <span class="text-amber-400 font-semibold">unuja.ac.id</span>
                            </p>
                        </div>
                    </div>
                @endforelse

            </div>
        </section>

        <!-- Center Column: Video (Top) & Info (Bottom) -->
        <section class="h-full flex flex-col border-r-2 border-slate-700">
            
            <!-- Video Section (Top 60%) -->
            <div class="video-section bg-black relative border-b-2 border-slate-700" style="height: 60%;">
                <div id="video-player-container" class="w-full h-full">
                </div>
            </div>

            <!-- Important Information Section (Bottom 40%) -->
            <div class="info-section bg-gradient-to-br from-slate-800 to-slate-700 flex flex-col overflow-hidden" style="height: 40%;">
                <div class="section-header border-b-4 border-amber-400 flex-shrink-0 bg-slate-900/50">
                    <h2 class="font-black text-amber-400 tracking-wide uppercase">INFORMASI PENTING</h2>
                </div>

                <div id="info-slideshow-container" class="slideshow-container flex-grow min-h-0">

                    @forelse($infos as $info)
                        <div class="slide info-slide info-content-box flex flex-col h-full justify-center">
                            <h3 class="info-title font-black text-amber-400 text-center leading-tight">
                                {{ $info->title }}
                            </h3>
                            <p class="info-message text-slate-200 text-center font-medium">
                                {{ $info->message }}
                            </p>
                            <div class="info-meta text-center mt-3">
                                <span class="text-slate-400 text-sm">
                                    📝 {{ $info->user->name ?? 'Admin' }} • 
                                    📅 {{ $info->created_at ? $info->created_at->format('d M Y, H:i') : '-' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="slide info-slide info-content-box flex flex-col h-full justify-center" style="opacity: 1;">
                            <h3 class="info-title font-black text-amber-400 text-center">
                                Tidak Ada Informasi
                            </h3>
                            <p class="info-message text-slate-200 text-center">
                                Belum ada informasi penting saat ini.
                            </p>
                        </div>
                    @endforelse

                </div>
            </div>

        </section>

        <!-- Right Column: Schedule (Top) & Chat Notifications (Bottom) -->
        <section class="h-full flex flex-col">
            
            <!-- Schedule Section (Top 55%) -->
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 flex flex-col overflow-hidden border-b-2 border-slate-700" style="height: 55%;">
                <div class="section-header border-b-4 border-amber-400 flex-shrink-0 bg-slate-900/70">
                    <h2 class="font-black text-amber-400 tracking-wide uppercase">JADWAL KULIAH</h2>
                </div>

                <div id="jadwal-container" class="flex-grow overflow-hidden p-2">
                    <!-- Jadwal akan dirender oleh JavaScript -->
                </div>
            </div>

            <!-- Chat Bubble Notifications Section (Bottom 45%) -->
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 flex flex-col overflow-hidden" style="height: 45%;">
                <div class="section-header border-b-4 border-amber-400 flex-shrink-0 bg-slate-900/70">
                    <h2 class="font-black text-amber-400 tracking-wide uppercase">NOTIFIKASI</h2>
                </div>

                <div class="flex-grow overflow-hidden" id="notification-wrapper">
                    <div id="notification-container">
                        <!-- Notifikasi akan dirender oleh JavaScript -->
                    </div>
                </div>
            </div>

        </section>

    </main>

    <footer class="px-6 py-3 bg-slate-800 border-t-4 border-amber-400 overflow-hidden whitespace-nowrap z-10">
        @if ($announcements->isEmpty())
            <div class="inline-block">
                <span class="text-xl mx-12 text-slate-200 font-medium">
                    Tidak ada pengumuman saat ini.
                </span>
            </div>
        @else
            <div class="inline-block animate-ticker">
                @for ($i = 0; $i < 2; $i++)
                    @foreach ($announcements as $announcement)
                        <span class="text-xl mx-16 text-slate-100 font-semibold">
                            🔔 {{ $announcement->title }}
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

        // Prepare schedule data for JavaScript with short prodi code
        $prodiCodes = ['TI', 'TE', 'SI', 'MJ', 'AK', 'HK', 'MI', 'TK'];
        $jsScheduleData = $schedules->map(function ($schedule, $index) use ($prodiCodes) {
            return [
                'time' => ($schedule->start_time ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i') : '-') . 
                          ($schedule->end_time ? ' - ' . \Carbon\Carbon::parse($schedule->end_time)->format('H:i') : ''),
                'course' => $schedule->course->name ?? 'N/A',
                'prodi' => $prodiCodes[$index % count($prodiCodes)],
                'lecturer' => $schedule->lecturer->name ?? 'Dosen tidak diatur',
                'room' => $schedule->room->name ?? 'N/A',
            ];
        })->values();

        // Prepare notification data using notifications table (filtered by today's date)
        $jsNotificationData = $notifications->map(function ($notification) {
            return [
                'sender' => $notification->creator->name ?? 'Admin',
                'message' => $notification->message,
                'date' => $notification->date ? $notification->date->format('d M Y') : '-',
                'time' => $notification->date ? $notification->date->format('H:i') : '-',
            ];
        })->values();
    @endphp

    <script>
        const videoData = @json($jsVideoData);
        const scheduleData = @json($jsScheduleData);
        const notificationData = @json($jsNotificationData);
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
                news: 13,
                info: 11,
                jadwal: 12,
                notification: 8
            };

            setupJsSlideshow('news-slideshow-container', '.news-slide', animationDurations.news);
            setupJsSlideshow('info-slideshow-container', '.info-slide', animationDurations.info);

            // ===== ADAPTIVE SCHEDULE SYSTEM =====
            function calculateScheduleCount() {
                const container = document.getElementById('jadwal-container');
                if (!container) return 6;
                
                const containerHeight = container.clientHeight;
                const screenWidth = window.innerWidth;
                
                // For 43" TV (1920x1080) show 6, smaller screens show less
                if (screenWidth >= 1800) return 6;
                if (screenWidth >= 1400) return 4;
                if (screenWidth >= 1000) return 4;
                return 2;
            }

            function getScheduleGridConfig(count) {
                switch(count) {
                    case 6: return { cols: 2, rows: 3 };
                    case 4: return { cols: 2, rows: 2 };
                    case 2: return { cols: 1, rows: 2 };
                    default: return { cols: 2, rows: 3 };
                }
            }

            function renderSchedules() {
                const container = document.getElementById('jadwal-container');
                if (!container) return;

                const count = calculateScheduleCount();
                const grid = getScheduleGridConfig(count);

                if (!scheduleData || scheduleData.length === 0) {
                    container.innerHTML = `
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="schedule-card bg-slate-700/50 text-center border-2 border-slate-600 p-4">
                                <h3 class="info-title font-black text-white mb-2">Tidak Ada Jadwal</h3>
                                <p class="info-message text-slate-300">Tidak ada jadwal kuliah hari ini.</p>
                            </div>
                        </div>
                    `;
                    return;
                }

                // Create slides with proper chunking
                const chunks = [];
                for (let i = 0; i < scheduleData.length; i += count) {
                    chunks.push(scheduleData.slice(i, i + count));
                }

                container.innerHTML = `
                    <div class="slideshow-container w-full h-full" id="schedule-slideshow">
                        ${chunks.map((chunk, chunkIdx) => `
                            <div class="slide schedule-slide w-full h-full" style="opacity: ${chunkIdx === 0 ? 1 : 0};">
                                <div class="grid h-full" style="grid-template-columns: repeat(${grid.cols}, 1fr); grid-template-rows: repeat(${grid.rows}, 1fr); gap: clamp(0.4rem, 0.8vh, 0.7rem);">
                                    ${chunk.map(schedule => `
                                        <div class="schedule-card bg-slate-700/60 backdrop-blur-sm border-2 border-slate-600 hover:border-amber-400/50">
                                            <div class="schedule-header">
                                                <span class="schedule-time font-bold text-amber-400">${schedule.time}</span>
                                                <span class="schedule-prodi">${schedule.prodi}</span>
                                            </div>
                                            <h3 class="schedule-course font-black text-white">${schedule.course}</h3>
                                            <p class="schedule-lecturer text-slate-300">${schedule.lecturer}</p>
                                            <p class="schedule-room text-amber-300 font-bold">${schedule.room}</p>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        `).join('')}
                    </div>
                `;

                // Setup slideshow for schedules
                if (chunks.length > 1) {
                    setupJsSlideshow('schedule-slideshow', '.schedule-slide', animationDurations.jadwal);
                }
            }

            // ===== ADAPTIVE NOTIFICATION SYSTEM =====
            let notificationIndex = 0;
            let notificationInterval = null;

            function calculateNotificationCount() {
                const wrapper = document.getElementById('notification-wrapper');
                if (!wrapper) return 3;
                
                const wrapperHeight = wrapper.clientHeight;
                // Base: 3 notifications at 100% screen (1080p)
                // Show 4 if screen is larger and can fit more
                // Each notification bubble ~80px with 3-line message
                const estimated = Math.floor(wrapperHeight / 80);
                return Math.max(3, Math.min(estimated, 4));
            }

            function renderNotifications() {
                const container = document.getElementById('notification-container');
                if (!container) return;

                if (!notificationData || notificationData.length === 0) {
                    container.innerHTML = `
                        <div class="chat-bubble">
                            <div class="chat-header">
                                <span class="chat-admin">👤 Sistem</span>
                                <span class="chat-datetime">-</span>
                            </div>
                            <div class="message">Tidak ada notifikasi saat ini.</div>
                        </div>
                    `;
                    return;
                }

                const count = calculateNotificationCount();
                const startIdx = notificationIndex % notificationData.length;
                const visibleNotifications = [];
                
                for (let i = 0; i < count && i < notificationData.length; i++) {
                    const idx = (startIdx + i) % notificationData.length;
                    visibleNotifications.push(notificationData[idx]);
                }

                // Add blink class for animation
                container.classList.add('notification-blink');

                container.innerHTML = visibleNotifications.map((notif, idx) => `
                    <div class="chat-bubble" style="animation-delay: ${idx * 0.1}s;">
                        <div class="chat-header">
                            <span class="chat-admin">👤 ${notif.sender}</span>
                            <span class="chat-datetime">${notif.date}, ${notif.time}</span>
                        </div>
                        <div class="message">${notif.message}</div>
                    </div>
                `).join('');

                // Remove blink class after animation
                setTimeout(() => {
                    container.classList.remove('notification-blink');
                }, 1000);
            }

            function rotateNotifications() {
                if (!notificationData || notificationData.length === 0) return;
                
                const count = calculateNotificationCount();
                notificationIndex = (notificationIndex + count) % notificationData.length;
                renderNotifications();
            }

            function startNotificationRotation() {
                if (notificationInterval) clearInterval(notificationInterval);
                
                renderNotifications();
                
                // Only rotate if there are more notifications than visible
                const count = calculateNotificationCount();
                if (notificationData && notificationData.length > count) {
                    notificationInterval = setInterval(rotateNotifications, animationDurations.notification * 1000);
                }
            }

            // Initial render
            renderSchedules();
            startNotificationRotation();

            // Handle window resize
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    renderSchedules();
                    startNotificationRotation();
                }, 250);
            });

            startVideoPlayerIfReady();
        });
    </script>

</body>

</html>

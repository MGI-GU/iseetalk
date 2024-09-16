(function($) {

    $.fn.audioSlideshow = function(options) {

        var settings = {
            jPlayerPath: "/lib/swf",
            suppliedFileType: "mp3",
            playSelector: ".audio-play",
            pauseSelector: ".audio-pause",
            currentTimeSelector: ".play-time",
            durationSelector: ".total-time",
            playheadSelector: ".playhead",
            timelineSelector: ".timeline",
            seekbarSelector: ".seekbar",
            volumelineSelector: ".jp-volume-slider",
            cssSelectorAncestor: "#jp_container_1",
        };

        if (options) {
            jQuery.extend(settings, options);
        }

        // Begin to iterate over the jQuery collection that the method was called on
        return this.each(function() {

            // Cache `this`
            var $that = $(this),
                $slides = $that.find('.audio-slides').children(),

                $currentTime = $that.find(settings.currentTimeSelector),
                $duration = $that.find(settings.durationSelector),
                $playhead = $that.find(settings.playheadSelector),
                $timeline = $that.find(settings.timelineSelector),
                $seekbar = $that.find(settings.seekbarSelector),
                $volumeline = $that.find(settings.volumelineSelector),
                $playButton = $that.find(settings.playSelector),
                $pauseButton = $that.find(settings.pauseSelector),

                slidesCount = $slides.length,
                slideTimes = new Array(),
                audioDurationinSeconds = parseInt($that.attr('data-audio-duration')),
                isPlaying = false,
                currentSlide = -1

            $pauseButton.hide();

            // Setup slides			
            $slides.each(function(index, el) {
                var $el = $(el);
                $el.hide();

                var second = parseInt($el.attr('data-slide-time')),
                    thumbnail = $el.attr('data-thumbnail');

                if (index > 0) {
                    slideTimes.push(second);
                    var seconds = second % 60;
                    var foo = second - seconds;
                    var minutes = foo / 60;
                    var minute = minutes % 60;
                    var fooM = minutes - minute;
                    var hour = fooM / 60;
                    if (seconds < 10) {
                        seconds = "0" + seconds.toString();
                    }
                    if (minute < 10) {
                        minute = "0" + minute.toString();
                    }
                    if (hour < 1) {
                        var time_text = minutes + ":" + seconds;
                    } else {
                        var time_text = hour + ":" + minute + ":" + seconds;
                    }
                    var l = (second / audioDurationinSeconds) * 100; //$that.width();
                    var fixedCurrentTime = time_text;
                    var img = '<span style="left:' + (l > 90 ? -Math.abs(l) : 0) + 'px;"><img src="' + thumbnail + '"><center>' + fixedCurrentTime + '</center></span>',
                        $marker = $('<a href="javascript:;" class="marker" data-time="' + second + '">' + img + '</a>');

                    // console.log(audioDurationinSeconds);
                    // console.log(Math.round(l * 100) / 100 + '%');
                    $marker.css('left', Math.round(l * 100) / 100 + '%').click(function(e) {
                        // $jPlayerObj.jPlayer("pause", parseInt($(this).attr('data-time')) + 50);
                        // $jPlayerObj.jPlayer("pause", parseInt($(this).attr('data-time'))) - 10;
                    });

                    $seekbar.append($marker);
                }
            });

            var $jPlayerObj = $('<div></div>');

            $that.append($jPlayerObj);

            $jPlayerObj.jPlayer({
                ready: function(event) {
                    if (document.getElementById("audio").duration >= 3600) {
                        $.jPlayer.timeFormat.showHour = true;
                    }
                    // Hide the volume slider on mobile browsers. ie., They have no effect.
                    if (event.jPlayer.status.noVolume) {
                        // Add a class and then CSS rules deal with it.
                        $(".jp-gui").addClass("jp-no-volume");
                    }
                    var cvolume = getCookie("volume");
                    if (cvolume != "") {
                        $(this).jPlayer("volume", cvolume);
                    } else {
                        $(this).jPlayer("volume", 0.5);
                    }
                    $(this).jPlayer("setMedia", {
                        mp3: $that.attr('data-audio')
                    });
                    if (window.location.href.includes("listen")) {
                        $(this).jPlayer("play", 1);
                    }

                    var ctimeplay = getCookie("timeplay");
                    var curlaudio = getCookie("audio_url");
                    if (ctimeplay > 0 && curlaudio == window.location.href) {
                        $(this).jPlayer("play", parseInt(ctimeplay));
                    } else {
                        $(this).jPlayer("play", 0);
                    }
                },
                swfPath: settings.jPlayerPath,
                supplied: settings.suppliedFileType,
                preload: 'auto',
                cssSelectorAncestor: "",
                smoothPlayBar: true,
                ended: function() { // The $.jPlayer.event.ended event
                    stopNext();
                }
            });

            // Add a listener to report the time play began
            // When play check slide should show
            // 
            $jPlayerObj.bind($.jPlayer.event.timeupdate, function(event) {
                var curTime = event.jPlayer.status.currentTime;
                if (curTime !== 0) {
                    if (event.jPlayer.status.currentTime !== 0) {
                        setCookie('timeplay', event.jPlayer.status.currentTime, 30);
                    }
                }

                audioDurationinSeconds = event.jPlayer.status.duration;
                var p = (curTime / audioDurationinSeconds) * 100 + "%";
                //var p = (curTime / audioDurationinSeconds) * $that.width();
                // console.log(p);
                $currentTime.text($.jPlayer.convertTime(curTime));
                $duration.text($.jPlayer.convertTime(audioDurationinSeconds));

                $playhead.width(p);

                if (slidesCount) {
                    var nxtSlide = 0;
                    for (var i = 0; i < slidesCount; i++) {
                        if (slideTimes[i] < curTime) {
                            nxtSlide = i + 1;
                        }
                    }
                    setAudioSlide(nxtSlide);
                }
            });

            $jPlayerObj.bind($.jPlayer.event.play, function(event) { // Add a listener to report the time play began
                isPlaying = true;
                $playButton.hide();
                $pauseButton.show();
                $slides.click(function(event) {
                    $jPlayerObj.jPlayer("pause");
                });
            });

            $jPlayerObj.bind($.jPlayer.event.pause, function(event) { // Add a listener to report the time pause began
                isPlaying = false;
                $pauseButton.hide();
                $playButton.show();
                if (event.jPlayer.status.currentTime !== 0) {
                    setCookie('timeplay', event.jPlayer.status.currentTime, 30);
                }
                $slides.click(function(event) {
                    $jPlayerObj.jPlayer("play");
                });
            });

            $jPlayerObj.bind($.jPlayer.event.volumechange, function(event) { // Add a listener to report the time pause began
                if (event.jPlayer.options.muted) {
                    $volumeline.slider("value", 0);
                    setCookie('volume', 0, 30);
                } else {
                    $volumeline.slider("value", event.jPlayer.options.volume);
                    setCookie('volume', event.jPlayer.options.volume, 30);
                }
            });

            function stopNext() {
                if ($('input#auto').is(':checked') == true || $('input[value="auto_play"]').is(':checked') == true) {
                    var $url = $("#next-list").next().attr('href') ? $("#next-list").next().attr('href') : 'false';
                    //alert($url);
                    if ($url == 'false') {
                        var $next = $("#next-audio").attr('href') ? $("#next-audio").attr('href') : 'false';
                        //alert($next+"2");
                        if ($next == 'false') {
                            return false;
                        } else {
                            $url = window.location.origin + '/listen/' + $next;
                            window.location.href = $url;
                            return false;
                        }
                    } else {
                        //alert($url+"1");
                        window.location.href = $url;
                        return false;
                    }
                    // alert('wrong');
                } else {
                    console.log('unchecked');
                }
                console.log('pass auto');
            }

            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toGMTString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }

            $slides.click(function(event) {
                $jPlayerObj.jPlayer("play");
            });

            $playButton.click(function(event) {
                $jPlayerObj.jPlayer("play");
            });

            $pauseButton.click(function(event) {
                // if(event.jPlayer.status.currentTime!==0){
                // 	setCookie('timeplay', event.jPlayer.status.currentTime, 30);
                // }
                $jPlayerObj.jPlayer("pause");
            });

            $timeline.click(function(event) {
                var l = event.pageX - $(this).offset().left;
                var t = (l / $that.width()) * audioDurationinSeconds;
                // $jPlayerObj.jPlayer("pause", t);
                $jPlayerObj.jPlayer("pause", parseInt($(this).attr('data-time')));
                // console.log(event.pageX);
            });

            // Create the volume slider control
            $volumeline.slider({
                animate: "fast",
                max: 1,
                range: "min",
                step: 0.01,
                value: $.jPlayer.prototype.options.volume,
                slide: function(event, ui) {
                    $jPlayerObj.jPlayer("option", "muted", false);
                    $jPlayerObj.jPlayer("option", "volume", ui.value);
                }
            });

            // Define hover states of the buttons
            $('.jp-gui ul li').hover(
                function() { $(this).addClass('ui-state-hover'); },
                function() { $(this).removeClass('ui-state-hover'); }
            );

            setAudioSlide(0);

            function setAudioSlide(n) {
                if (n != currentSlide) {
                    if ($slides.get(currentSlide)) {
                        $($slides.get(currentSlide)).hide();
                    }

                    $($slides.get(n)).show();
                    currentSlide = n;
                }
            };

            $('.seekbar').mouseup(function(e) {
                updatebar(e.pageX);
            });

            function updatebar(x) {
                var progress = $('.timeline');
                var maxduration = audioDurationinSeconds; //audio duration
                var position = x - progress.offset().left; //Click pos
                var percentage = 100 * position / progress.width();

                //Check within range
                if (percentage > 100) {
                    percentage = 100;
                }
                if (percentage < 0) {
                    percentage = 0;
                }
                // if (percentage > 20) {
                // 	percentage = percentage-1;
                // }
                // if (percentage > 50) {
                // 	percentage = percentage-1;
                // }
                // if (percentage > 80) {
                // 	percentage = percentage-1;
                // }
                var pos = maxduration * percentage / 100;
                // console.log(maxduration);
                // console.log(percentage);
                // console.log(pos);

                $jPlayerObj.jPlayer("pause", pos);

                //Update progress bar and video currenttime
                // $('.jp-ball').css('left', percentage + '%');
                // $('.playhead').css('width', percentage + '%');
                // $jPlayerObj.jPlayer.currentTime = maxduration * percentage / 100;
            };

            window.onbeforeunload = function(e) {
                setCookie('audio_url', window.location.href, 30);
                $jPlayerObj.jPlayer("pause");
            };

        });
    };

    $(document).ready(function() {
        $('#audio-slideshow').audioSlideshow();
    });
}(jQuery));
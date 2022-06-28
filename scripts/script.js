'use strict'
void function ($) {
    const animationConfig = {
        animationInterval: null, moveStep: 1, pointDiameter: 16, animationSpeed: 60
    };

    /**
     * Auto-execute after script load and document is ready
     */
    $(() => {
        initBackground();
        initTheme();
    })

    function initBackground() {
        bindStopAnimation();
        bindStartAnimation();
        bindRandomizeAnimation();
        randomizePoints();
        startAnimation();
    }

    function startAnimation() {
        animationConfig.animationInterval = setInterval(animateBackground, animationConfig.animationSpeed);
    }

    function randomizePoints() {
        let livePoints = $('#live-background .live-point');

        if (livePoints.length === 0) return;

        $.each(livePoints, (ix, lp) => {
            randomizeLivePoint($(lp))
        })
    }

    function initTheme() {
        determineTheme();
        bindSwitchLightTheme();
        bindSwitchDarkTheme();
    }

    function determineTheme() {
        if (getPreferredThemeFromCookie() === "DARK" || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            switchToDarkTheme()
        } else if (getPreferredThemeFromCookie() === "LIGHT" || (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches)) {
            switchToLightTheme()
        }

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
            event.matches ? switchToDarkTheme() : switchToLightTheme();
        });
    }

    function bindSwitchLightTheme() {
        $(".js-theme-light").click(() => {
            document.cookie = "ftw_prefers_theme=light; max-age=36000 ;Secure";
            switchToLightTheme();
        });
    }

    function bindSwitchDarkTheme() {
        $(".js-theme-dark").click(() => {
            document.cookie = "ftw_prefers_theme=dark; max-age=36000 ;Secure";
            switchToDarkTheme();
        });
    }

    function getPreferredThemeFromCookie() {
        if (document.cookie.split(';').some((item) => item.includes('ftw_prefers_theme=dark'))) {
            return "DARK";
        }
        if (document.cookie.split(';').some((item) => item.includes('ftw_prefers_theme=light'))) {
            return "LIGHT";
        }
        return "";
    }

    function switchToLightTheme() {
        let body = $("body");
        if (body.hasClass("theme-dark")) {
            body.removeClass("theme-dark")
        }
        body.addClass("theme-light")
        $(".js-theme-dark").show();
        $(".js-theme-light").hide();
    }

    function switchToDarkTheme() {
        let body = $("body");
        if (body.hasClass("theme-light")) {
            body.removeClass("theme-light")
        }
        body.addClass("theme-dark")
        $(".js-theme-dark").hide();
        $(".js-theme-light").show();
    }

    function bindStopAnimation() {
        $(".js-stop-animation").click(() => {
            if (animationConfig.animationInterval != null) {
                clearInterval(animationConfig.animationInterval);
                animationConfig.animationInterval = null;
                $(".js-stop-animation").hide();
                $(".js-start-animation").show()
                $(".js-randomize-animation").show()
            }
        })
    }

    function bindStartAnimation() {
        $(".js-start-animation").click(() => {
            if (animationConfig.animationInterval == null) {
                startAnimation();
                $(".js-start-animation").hide()
                $(".js-randomize-animation").hide()
                $(".js-stop-animation").show()
            }
        })
    }

    function bindRandomizeAnimation() {
        $(".js-randomize-animation").click(() => {
            if (animationConfig.animationInterval == null) {
                randomizePoints();
            }
        })
    }

    function animateBackground() {
        let livePoints = $('#live-background .live-point');

        if (livePoints.length === 0) return;

        $.each(livePoints, (ix, lp) => {
            moveLivePoint($(lp));
        })
    }

    function randomizeLivePoint(lp) {
        const directions = ['tl', 'tr', 'bl', 'br'];
        const sizes = [50, 75, 100, 125, 150];
        const speed = [1, 1.1, 1.2, 1.3, 1.4];

        const random_direction_ix = randomIntFromInterval(0, 3);
        const random_size_ix = randomIntFromInterval(0, 4);
        const random_speed_ix = randomIntFromInterval(0, 4);
        const random_pt = randomIntFromInterval(0, window.innerHeight - animationConfig.pointDiameter);
        const random_pl = randomIntFromInterval(0, window.innerWidth - animationConfig.pointDiameter);
        lp.addClass(`size-${sizes[random_size_ix]}`);
        lp.attr('data-speed', speed[random_speed_ix]);
        setLivePointPos(lp, random_pt, random_pl, directions[random_direction_ix]);
    }

    function moveLivePoint(lp) {
        let d = lp.attr('data-direction');
        let pt = parseInt(lp.attr('data-pt'));
        let pl = parseInt(lp.attr('data-pl'));
        let sp = parseFloat(lp.attr('data-speed'));
        let scaledMoveStep = animationConfig.moveStep * sp
        pt += d.startsWith("b") ? scaledMoveStep : -scaledMoveStep;
        pl += d.endsWith("r") ? scaledMoveStep : -scaledMoveStep;

        if (pt < -animationConfig.pointDiameter) {
            pt = -animationConfig.pointDiameter;
            d = d === "tl" ? "bl" : "br";
        } else if ((pt - animationConfig.pointDiameter) >= window.innerHeight) {
            pt = window.innerHeight;
            d = d === "bl" ? "tl" : "tr";
        }

        if (pl < -animationConfig.pointDiameter) {
            pl = -animationConfig.pointDiameter;
            d = d === "tl" ? "tr" : "br";
        } else if ((pl - animationConfig.pointDiameter) >= window.innerWidth) {
            pl = window.innerWidth;
            d = d === "tr" ? "tl" : "bl";
        }

        setLivePointPos(lp, pt, pl, d);
    }

    function setLivePointPos(lp, pt, pl, dir) {
        lp.attr('data-direction', dir);
        lp.attr("data-pt", pt);
        lp.attr("data-pl", pl);
        lp.css("top", `${pt}px`);
        lp.css("left", `${pl}px`);
    }

    function randomIntFromInterval(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min)
    }

}(jQuery)

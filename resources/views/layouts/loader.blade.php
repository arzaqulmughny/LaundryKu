<div id="loader-background">
    <span class="loader"></span>
</div>

<style>
    #loader-background {
        position: fixed;
        width: 100vw;
        height: 100vh;
        background-color: #FFF;
        z-index: 999;
        left: 0;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader {
        width: 48px;
        height: 48px;
        border: 2px solid #0084d1;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
    }

    .loader::after,
    .loader::before {
        content: '';
        box-sizing: border-box;
        position: absolute;
        left: 0;
        top: 0;
        background: #0084d1;
        width: 6px;
        height: 6px;
        transform: translate(150%, 150%);
        border-radius: 50%;
    }

    .loader::before {
        left: auto;
        top: auto;
        right: 0;
        bottom: 0;
        transform: translate(-150%, -150%);
    }

    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<script>
     document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            document.getElementById('loader-background').style.display = 'none'
        }, 500)
    })
</script>
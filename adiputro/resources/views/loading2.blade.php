<style>
    #loading2 {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 54vh;
        background-color: #f5f5f5;
    }

    .spinner {
        border: 4px solid #ccc;
        border-top-color: #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<div id="loading2">
    <div class="spinner"></div>
</div>

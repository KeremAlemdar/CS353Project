<!DOCTYPE html>
<html>
<style>
    .ticketsContainer {
        width: 1800px;
        height: 400px;
    }

    .ticketItem {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: row;
        margin-bottom: 40px;
    }

    .informations {
        background-color: black;
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 80%;
    }

    .departure {
        background-color: gray;
        display: flex;
        justify-content: space-between;
        flex-direction: row;
        align-items: center;
        height: 50%;
        width: 80%;
        margin: auto;
    }

    .arrival {
        background-color: blue;
        display: flex;
        justify-content: space-between;
        flex-direction: row;
        align-items: center;
        height: 50%;
        width: 80%;
        margin: auto;
    }

    .price {
        background-color: violet;
        height: 100%;
        width: 20%;
        text-align: center;
        display: flex;
        align-items: flex-end;
    }
</style>

<div class="ticketsContainer">
    <?php
    for ($vacation = 0; $vacation < 2; $vacation++) {
    ?>
        <div class="ticketItem">
            <div class="informations">
                <div class="departure">
                    <img src="https://content.r9cdn.net/rimg/provider-logos/airlines/v/PC.png?crop=false&width=108&height=92&fallback=default1.png&_v=e574f35253dcd377492e2002db829c55" alt="asd">
                    <div style="display: flex; flex-direction:row;">
                        <h3>13:30 <br /> ESB</h3>
                        <span style="margin:auto">------------------------</span>
                        <h3>13:30 <br /> ESB</h3>
                    </div>
                    <h2>1:30 Hour</h2>
                </div>
                <div class="arrival">
                    <img src="https://content.r9cdn.net/rimg/provider-logos/airlines/v/PC.png?crop=false&width=108&height=92&fallback=default1.png&_v=e574f35253dcd377492e2002db829c55" alt="asd">
                    <div style="display: flex; flex-direction:row;">
                        <h3>13:30 <br /> ESB</h3>
                        <span style="margin:auto">------------------------</span>
                        <h3>13:30 <br /> ESB</h3>
                    </div>
                    <h2>1:30 Hour</h2>
                </div>
            </div>
            <div class="price">
                <div style="margin-left: auto; margin-right: auto; margin-bottom:30px">
                    <h1>120 dolar işareti</h1>
                    <button onclick=""> BUY </button>
                </div>

            </div>
        </div>
    <?php } ?>
</div>

</html>
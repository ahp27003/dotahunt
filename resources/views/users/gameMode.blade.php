@php
    if($recent['game_mode'] == 1)
    {
        echo 'All Pick';
    }
    elseif($recent['game_mode'] == 22)
    {
        echo 'RANKED MMR';
    }
    elseif($recent['game_mode'] == 23)
    {
        echo 'Turbo';
    }
    elseif($recent['game_mode'] == 2)
    {
        echo 'Captains Mode';
    }
    elseif($recent['game_mode'] == 3)
    {
        echo 'Random Draft';
    }
    elseif($recent['game_mode'] == 4)
    {
        echo 'Single Draft';
    }
    elseif($recent['game_mode'] == 5)
    {
        echo 'All Random';
    }
    elseif($recent['game_mode'] == 11)
    {
        echo 'Mid Only';
    }
    elseif($recent['game_mode'] == 14)
    {
        echo 'Compendium Matchmaking';
    }
    elseif($recent['game_mode'] == 15)
    {
        echo 'Custom';
    }
    elseif($recent['game_mode'] == 16)
    {
        echo 'Captain Draft';
    }
    elseif($recent['game_mode'] == 17)
    {
        echo 'Balanced Draft';
    }
    elseif($recent['game_mode'] == 18)
    {
        echo 'Ablity Draft';
    }
    elseif($recent['game_mode'] == 19)
    {
        echo 'Event';
    }
    elseif($recent['game_mode'] == 20)
    {
        echo 'All Random Death Match';
    }
    elseif($recent['game_mode'] == 21)
    {
        echo '1v1 Mid';
    }
    else {
        echo 'Unknown';
    }
@endphp
<br>

    @php
        if($recent['skill'] == 1)
        {
            echo 'Normal Skill';
        }
        elseif ($recent['skill'] == 2)
        {
            echo 'High Skill';
        }
        else {
            echo 'Very High Skill';
        }

    @endphp

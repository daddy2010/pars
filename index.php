<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table>
            <tr>
                <td>Прогноз Scometix</td>
                <td>Прогноз пользователей</td>
                <td>Название 1-й комманды</td>
                <td>Название 2-й комманды</td>
                <td>Коэффициент 1-й комманды </td>
                <td>Коэффициент исхода матча "ничья" </td>
                <td>Коэффициент 2-й комманды </td>
                <td>Процентные соотношения коэффицентов 1-й комманды</td>
                <td>Процентные соотношения коэффицентов исхода матча "ничья"</td>
                <td>Процентные соотношения коэффицентов 2-й комманды</td>
                <td>Процентные соотношения голосов 1-й комманды</td>
                <td>Процентные соотношения голосов исхода матча "ничья"</td>
                <td>Процентные соотношения голосов 2-й комманды</td>
                <td>Кол-во голосовавших</td>
                <td>Распределение голосов 1-й комманды</td>
                <td>Распределение голосов исхода матча "ничья"</td>
                <td>Распределение голосов 2-й комманды</td>
            </tr>
        <?php
        require_once 'vendor/autoload.php';
        use GuzzleHttp\Client;
        use Bariew\phpQuery;
        
        $client = new Client();$url = $client->request('GET', 'http://ru.scometix.com/turkey/tff-1-league/316776-2016/vestel-manisaspor-samsunspor.htm');
        //    $url = $client->request('GET', 'http://ru.scometix.com/europe/champions-league-gruppo-a/307437-2016/basel-paris-saint-germain.htm');
            $body = $url->getBody();
            $document = \phpQuery::newDocumentHTML($body,'UTF8');
            $links = pq($document)->find('#ContentInner > div.TwoColumns > div.LeftColumn');
            $nameFirst = pq($links)->find('#BoxPronoSquadre > a:nth-child(1) > span')->text();
            $nameSecond = pq($links)->find('#BoxPronoSquadre > a:nth-child(3) > span')->text();
            $forecastScometix = pq($links)->find('div:nth-child(5) > div.QuoteBox');
            $forecastUsers = pq($links)->find('#PronoUtenti > div.QuoteBox');
            // Parser ratio scometix
            $ratioScometixOne = (double)pq($forecastScometix)->find('div.Bar > p.Quota.QT1 > span.Quote.CufonSymb')->text();
            $ratioScometixDraw = (double)pq($forecastScometix)->find('div.Bar > p.Quota.QTX > span.Quote.CufonSymb')->text(); 
            $ratioScometixTwo = (double)pq($forecastScometix)->find('div.Bar > p.Quota.QT2 > span.Quote.CufonSymb')->text();
            $ratioScometixPercentOne = pq($forecastScometix)->find('div.Bar > p.Quota.QT1 > span.Percent.CufonSymb')->text();
            $ratioScometixPercentDraw = pq($forecastScometix)->find('div.Bar > p.Quota.QTX > span.Percent.CufonSymb')->text();
            $ratioScometixPercentTwo = pq($forecastScometix)->find('div.Bar > p.Quota.QT2 > span.Percent.CufonSymb')->text();
            $forecast = (int)pq($forecastScometix)->find('div.BoxSegno > p.Segno')->text();
            // Parser ratio users
            $countUsers = pq($forecastUsers)->find('div.Bar > p.Title')->text();
            $ratioUsersOne = pq($forecastUsers)->find('div.Bar > p.Quota.QT1 > span.Quote.CufonSymb')->text();
            $ratioUsersDraw = pq($forecastUsers)->find('div.Bar > p.Quota.QTX > span.Quote.CufonSymb')->text();
            $ratioUsersTwo = pq($forecastUsers)->find('div.Bar > p.Quota.QT2 > span.Quote.CufonSymb')->text();
            $ratioUsersPercentOne = pq($forecastUsers)->find('div.Bar > p.Quota.QT1 > span.Percent.CufonSymb')->text();
            $ratioUsersPercentDraw = pq($forecastUsers)->find('div.Bar > p.Quota.QTX > span.Percent.CufonSymb')->text();
            $ratioUsersPercentTwo = pq($forecastUsers)->find('div.Bar > p.Quota.QT2 > span.Percent.CufonSymb')->text();
            $forecastUser = (int)pq($forecastUsers)->find('div.BoxSegno > p.Segno.CufonSymb')->text();
            if($ratioScometixOne <= $ratioScometixTwo){ // || $ratioScometixOne <= $ratioScometixDraw){   
                $forecasts = $forecast;
                $forecastUserss = $forecastUser;
                $nameFirsts = $nameFirst;
                $nameSeconds = $nameSecond;
                $ratioScometixOnes = $ratioScometixOne;
                $ratioScometixDraws = $ratioScometixDraw;
                $ratioScometixTwos = $ratioScometixTwo;
                $ratioScometixPercentOnes = $ratioScometixPercentOne;
                $ratioScometixPercentDraws = $ratioScometixPercentDraw;
                $ratioScometixPercentTwos = $ratioScometixPercentTwo;
                $ratioUsersPercentOnes = $ratioUsersPercentOne;
                $ratioUsersPercentDraws = $ratioUsersPercentDraw;
                $ratioUsersPercentTwos = $ratioUsersPercentTwo;
                $ratioUsersOnes = $ratioUsersOne;
                $ratioUsersDraws = $ratioUsersDraw;
                $ratioUsersTwos = $ratioUsersTwo;
            }
            elseif($ratioScometixTwo < $ratioScometixOne){// || $ratioScometixTwo <= $ratioScometixDraw){
                if($forecast === 1){
                    $forecasts = 2;
                }
                elseif($forecast === 2){
                    $forecasts = 1;
                }
                if($forecastUser === 1){
                    $forecastUserss = 2;
                }
                elseif($forecastUser === 2){
                    $forecastUserss = 1;
                }
                
                $nameFirsts = $nameSecond;
                $nameSeconds = $nameFirst;
                $ratioScometixOnes = $ratioScometixTwo;
                $ratioScometixDraws = $ratioScometixDraw;
                $ratioScometixTwos = $ratioScometixOne;
                $ratioScometixPercentOnes = $ratioScometixPercentTwo;
                $ratioScometixPercentDraws = $ratioScometixPercentDraw;
                $ratioScometixPercentTwos = $ratioScometixPercentOne;
                $ratioUsersPercentOnes = $ratioUsersPercentTwo;
                $ratioUsersPercentDraws = $ratioUsersPercentDraw;
                $ratioUsersPercentTwos = $ratioUsersPercentOne;
                $ratioUsersOnes = $ratioUsersTwo;
                $ratioUsersDraws = $ratioUsersDraw;
                $ratioUsersTwos = $ratioUsersOne;
            }
//            elseif($ratioScometixDraw <= $ratioScometixOne || $ratioScometixDraw <= $ratioScometixTwo){
//                $nameFirsts = $nameFirst;
//                $nameSeconds = $nameSecond;
//                $ratioScometixOnes = $ratioScometixDraw;
//                $ratioScometixDraws = $ratioScometixOne;
//                $ratioScometixTwos = $ratioScometixTwo;
//                $ratioScometixPercentOnes = $ratioScometixPercentDraw;
//                $ratioScometixPercentDraws = $ratioScometixPercentOne;
//                $ratioScometixPercentTwos = $ratioScometixPercentTwo;
//                $ratioUsersPercentOnes = $ratioUsersPercentDraw;
//                $ratioUsersPercentDraws = $ratioUsersPercentOne;
//                $ratioUsersPercentTwos = $ratioUsersPercentTwo;
//                $ratioUsersOnes = $ratioUsersDraw;
//                $ratioUsersDraws = $ratioUsersOne;
//                $ratioUsersTwos = $ratioUsersTwo;
//            }
            echo "<tr><td>$forecasts</td><td>$forecastUserss</td><td>$nameFirsts</td><td>$nameSeconds</td><td>$ratioScometixOnes</td><td>$ratioScometixDraws</td><td>$ratioScometixTwos</td><td>$ratioScometixPercentOnes</td><td>$ratioScometixPercentDraws</td><td>$ratioScometixPercentTwos</td><td>$ratioUsersPercentOnes</td><td>$ratioUsersPercentDraws</td><td>$ratioUsersPercentTwos</td><td>$countUsers</td><td>$ratioUsersOnes</td><td>$ratioUsersDraws</td><td>$ratioUsersTwos</td></tr>";
            
        ?>
        </table>
    </body>
</html>

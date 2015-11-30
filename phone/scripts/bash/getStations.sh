#!/bin/bash
set -x

source ../../common/config.bash

mth=$(date --date="today" +%m);
day=$(date --date="today" +%d);
yr=$(date --date="today" +%Y);

nday=$(date --date="tomorrow" +%d);

if [ -f Stations.tsv ]; then
		rm Stations.tsv;

		curl -o Stations.tsv -k "https://home-c8.incontact.com/ReportService/DataDownloadHandler.ashx?CDST=bihzCvaOS1phcem%2bgsd%2brurETLIgLAJnVx7rscFORxuLVvagcQzpmwTLFyizBsKNJ4DOR1ecsxk2o3ZLlWEDW4i2tr%2bbOiN1sbBexLIujRdnLeFss%2fcXI8XVVy6GrtQj8gaW4fHxKIIbIlKa5jfRPKxYrgcbgqRhJsRHYtcUHoIqEeo461LAiuTskA%3d%3d&DateFrom=$mth%2f$day%2f$yr+4%3a00%3a00+AM&DateTo=$mth%2f$nday%2f$yr+3%3a59%3a00+AM&Format=TAB&IncludeHeaders=False&AppendDate=False"

              	mysql -u${dbuser} -p${dbpass} -h${dbserver} voip -e "TRUNCATE TABLE Stations"

                ./putStations.php Stations.tsv


	else
	
		curl -o Stations.tsv -k "https://home-c8.incontact.com/ReportService/DataDownloadHandler.ashx?CDST=bihzCvaOS1phcem%2bgsd%2brurETLIgLAJnVx7rscFORxuLVvagcQzpmwTLFyizBsKNJ4DOR1ecsxk2o3ZLlWEDW4i2tr%2bbOiN1sbBexLIujRdnLeFss%2fcXI8XVVy6GrtQj8gaW4fHxKIIbIlKa5jfRPKxYrgcbgqRhJsRHYtcUHoIqEeo461LAiuTskA%3d%3d&DateFrom=$mth%2f$day%2f$yr+4%3a00%3a00+AM&DateTo=$mth%2f$nday%2f$yr+3%3a59%3a00+AM&Format=TAB&IncludeHeaders=False&AppendDate=False"

		mysql -u${dbuser} -p${dbpass} -h${dbserver} voip -e "TRUNCATE TABLE Stations"
		
		./putStations.php Stations.tsv
	fi

set +x

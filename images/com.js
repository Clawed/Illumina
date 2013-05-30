function tdGetCookie(name)
{
	var prefix = name + "=";
	var namePos = document.cookie.indexOf(prefix);
	if (namePos == -1)
		return (null);
	var valuePos = namePos + name.length + 1;
	var endPos = document.cookie.indexOf(";", valuePos);
	if (endPos == -1)
		endPos = document.cookie.length;
	return (unescape(document.cookie.substring(valuePos, endPos).replace(/\+/g, " ")));
}

function tdTrack()
{
	if (tdTrackBackUrl)
		tdTrackBackImg.src = tdTrackBackUrl;
}

function tdInit()
{
	var tduid = "";

	// Your organization ID
	//
	var organization = "973163";

	// Value of the sale.
	// Leave as "0.00" if not applicable.
	//
	var orderValue = "0.00";

	// Currency of the sale.
	// Leave as "EUR" if not applicable.
	//
	var currency = "EUR";

	// Event ID
	//
	var event = "93109";

	// Event type:
	//     true  = Sale
	//     false = Lead
	//
	var isSale = false;

	// Encrypted connection on this page:
	//     true  = Yes (https)
	//     false = No  (http)
	//
	var isSecure = true;

	// Here you must specify a unique identifier for the transaction.
	// For a sale, this is typically the order number.
	//
	var orderNumber = new Date().getTime();

	// OPTIONAL: You may transmit a list of items ordered in the reportInfo
	// parameter. See the implementation manual for details.
	//
	var reportInfo = "";
	var reportInfo = escape(reportInfo);


	/*****  IMPORTANT:                                                    *****/
	/*****  In most cases, you should not edit anything below this line.  *****/
	/*****  Please consult with TradeDoubler before modifying the code.   *****/


	if (tdGetCookie("TRADEDOUBLER"))
		tduid = tdGetCookie("TRADEDOUBLER");

	var domain, checkNumberName, scheme;

	if (isSale)
	{
		domain = "tbs.tradedoubler.com";
		checkNumberName = "orderNumber";
	}
	else
	{
		domain = "tbl.tradedoubler.com";
		checkNumberName = "leadNumber";
		orderValue = "1";
	}

	if (isSecure)
		scheme = "https";
	else
		scheme = "http";

	tdTrackBackUrl = scheme + "://" + domain + "/report"
				  + "?organization="            + organization
				  + "&event="                   + event
				  + "&" + checkNumberName + "=" + orderNumber
				  + "&tduid="                   + tduid
				  + "&reportInfo="              + reportInfo;

	if (isSale)
	{
		tdTrackBackUrl
			+= "&orderValue=" + orderValue
			+  "&currency="   + currency;
	}
}

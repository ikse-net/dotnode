function toggle_img(cat, elemt, value)
{
        image = new Array;
        if(cat==0)
                idx_max = 1;
        else
                idx_max = 5;
        for(idx=0; idx<idx_max; idx++)
                image[idx] = document.getElementById('icon'+cat+''+(idx+1)+''+elemt);

	for(idx=0; idx<idx_max; idx++)
                image[idx].src = "/img/karma/" + cat + "_b.png";
       image[value-1].src = "/img/karma/" + cat + ".png";

}

function click(cat, elemt, value)
{
        karma = document.getElementById('select'+cat+''+(elemt));
	if(karma.value == value)
		karma.value = 0;
	else
		karma.value = value;
        toggle_img(cat, elemt, karma.value);
}

initial_value = new Array;


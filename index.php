<?php

/**
* This class is drawing the canvas
*/
class statistic
{
	public $width = 800;  // give him a width
	public $height = 200; // give him a height
	public $canvasID = 'a';
	public $values = array(134,156,167,489,478,982); // give him values
	public $numGaps;
	public $gapWidth;
	public $totHeight;
	public $length;

	public function __construct()
	{
		$this->numGaps = count($this->values);
		$this->gapWidth = floor(($this->width - (40 + $this->numGaps*10))/($this->numGaps-1));

		$this->totHeight = ceil(max($this->values)/100)*100;
		$this->length = strlen($this->totHeight);

			echo '<canvas id="'.$this->canvasID.'" width="'.$this->width.'" height="'.$this->height.'"></canvas>';
		
	}
}

$canvas = new statistic;

?>

<script type="text/javascript" charset="utf-8">


		var names = new Array('Var 1','Var 2','Var 3','new'); // give the values some names
		var values = new Array(134,156,167,489,478,982); // give him values
		var graphColor = '#1A1CAB'; //change the color of the graph
		var subspaceColor = '#8CD490'; //change the color of the space below the graph

		var width = '<?php echo $canvas->width ?>';
		var height = '<?php echo $canvas->height ?>';
		var padding = '<?php echo $canvas->length ?>';
		var heightTot = '<?php echo $canvas->totHeight ?>';
		var gapWidth = '<?php echo $canvas->gapWidth ?>';
		var canvasID = '<?php echo $canvas->canvasID ?>';
		var numberfGaps = '<?php echo $canvas->numGaps ?>';
		
		var first_canvas = document.getElementById(canvasID);
		var context = first_canvas.getContext("2d");

		// context general font style
		context.font = "bold 12px sans-serif";

		// numbers on the left side
		context.fillText(0, 0, height-23);	
		context.fillText(heightTot, 0, +10);	
		context.fillText(heightTot*0.25, 0, (height-20)*0.750);	
		context.fillText(heightTot*0.5, 0, (height-20)*0.50);	
		context.fillText(heightTot*0.75, 0, (height-20)*0.250);	
		
		// fill path under the graph
		context.beginPath();
		context.moveTo(padding*7+2, (height-20)-values[0]/(heightTot/(height-20)));	
		for (var i = 0; i <= numberfGaps; i++) 
		{
			context.lineTo(padding*7+2+gapWidth*i, (height-20)-values[i]/(heightTot/(height-20)));
		}
			context.lineTo(padding*7+2+gapWidth*(numberfGaps-1), height-20);
			context.lineTo(padding*7+2, height-20);
			context.closePath();
		
		context.fillStyle=subspaceColor;
		context.fill();
		context.strokeStyle = "#fff";
		context.lineWidth = 1;
		context.stroke();


		// add some lines to the whole graph
		
		context.beginPath();

		context.moveTo(padding*7+2, (height-20)*0.750);
		context.lineTo(padding*7+2+gapWidth*(numberfGaps-1), (height-20)*0.750);
		context.moveTo(padding*7+2, (height-20)*0.50);
		context.lineTo(padding*7+2+gapWidth*(numberfGaps-1), (height-20)*0.50);
		context.moveTo(padding*7+2, (height-20)*0.250);
		context.lineTo(padding*7+2+gapWidth*(numberfGaps-1), (height-20)*0.250);
		context.moveTo(padding*7+2, height-20);
		context.lineTo(padding*7+2+gapWidth*(numberfGaps-1), height-20);
		context.moveTo(padding*7+2, 1);
		context.lineTo(padding*7+2+gapWidth*(numberfGaps-1), 1);

		context.strokeStyle = "#cfcfcf";
		context.lineWidth = 1;
		context.stroke();


		// construct graph
		context.fillStyle="#000";
		context.beginPath();
		context.moveTo(padding*7+2, (height-20)-values[0]/(heightTot/(height-20)));
		for (var i = 0; i <= numberfGaps; i++) 
		{
			context.fillText(names[i]+" "+values[i], padding*7+2+gapWidth*i, height-5);
			context.lineTo(padding*7+2+gapWidth*i, (height-20)-values[i]/(heightTot/(height-20)));
		}
		context.strokeStyle = graphColor;
		context.lineWidth = 5;
		context.stroke();

		
		// add bullet points to the graph
		for (var i = 0; i <= numberfGaps; i++) 
		{
			if (i) 
			{
				context.beginPath();
				context.arc(padding*7+2+gapWidth*i, (height-20)-values[i]/(heightTot/(height-20)), 3, 0, Math.PI * 2, false);
				context.closePath();
				context.fillStyle = graphColor;
   				context.fill();
				context.strokeStyle = graphColor;
				context.stroke();
			}else
			{
				context.beginPath();
				context.arc(padding*7+5+gapWidth*i, (height-20)-values[i]/(heightTot/(height-20)), 3, 0, Math.PI * 2, false);
				context.closePath();
				context.fillStyle = graphColor;
   				context.fill();
				context.strokeStyle = graphColor;
				context.stroke();
			}
		}


</script>

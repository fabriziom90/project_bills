<?php 

	namespace App\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use App\Entity\Bills;
	use App\Entity\BillRows;
	use App\Entity\User;
	use Symfony\Component\HttpFoundation\JsonResponse;

	/**
	 * @Route("/")
	 */
	class BaseController extends AbstractController
	{ 
         /**
	     * @Route("/", name="index")
	     */
	    public function indexView(Request $request)
	    {	
	    	$message = $request->request->get('message');

            $bills = $this->getDoctrine()->getRepository(Bills::class)->findAll();
            $users = $this->getDoctrine()->getRepository(User::class)->findAll();

            $billsDTO = array();
            foreach($bills as $bill){
            	$item = array();
            	$item['id'] = $bill->getId();
            	$item['date'] = $bill->getDate();
            	$item['number'] = $bill->getNumber();
            	$item['user'] = $bill->getFkUser()->getName()." ".$bill->getFkUser()->getSurname();
            	$item['description'] = $bill->getFkBillRows()->getDescription();
            	$item['quantity'] = $bill->getFkBillRows()->getQuantity();
            	$item['amount_free_iva'] = $bill->getFkBillRows()->getAmountIvaFree();
            	$item['amount_with_iva'] = $bill->getFkBillRows()->getAmountIvaIncluded();
            	$item['total'] = $bill->getFkBillRows()->getTotalIvaIncluded();

            	$billsDTO [] = $item;
            }

            return $this->render('index.html.twig', array(
                'message'	=> $message,
                'bills'     => $billsDTO,
                'users'		=> $users
        	));
	    }

	    /**
	     * @Route("/save_bill", name="saveBill")
	     */
	    public function saveBillAction(Request $request)
	    {	
	    	$em = $this->getDoctrine()->getManager();

	    	$date = $request->request->get('date');
	    	$number = $request->request->get('number');
	    	$user_id = $request->request->get('customer_id');
	    	$description = $request->request->get('description');
	    	$quantity = $request->request->get('quantity');
	    	$amount_free_iva = $request->request->get('amount_free_iva');
	    	$amount_with_iva = $request->request->get('amount_with_iva');
	    	$total = $request->request->get('total_with_iva');
	    	
	    	$user = $this->getDoctrine()->getRepository(User::class)->find($user_id);

	    	$date_obj = new \DateTime($date);

	    	if($date == ''){
	    		$message = 'You have to insert a date.';
	    		return new JsonResponse(array('result' => false, 'message' => $message));
	    	}

	    	if($number == ''){
	    		$message = 'You have to insert a bill\' number.';
	    		return new JsonResponse(array('result' => false, 'message' => $message));
	    	}

	    	if($user_id == ''){
	    		$message = 'You have to select the user.';
	    		return new JsonResponse(array('result' => false, 'message' => $message));
	    	}

	    	if($description == ''){
	    		$message = 'You have to insert a description.';
	    		return new JsonResponse(array('result' => false, 'message' => $message));
	    	}

	    	if($quantity == ''){
	    		$message = 'You have to insert a quantity.';
	    		return new JsonResponse(array('result' => false, 'message' => $message));
	    	}

	    	if($amount_free_iva == ''){
	    		$message = 'You have to insert an amount without iva.';
	    		return new JsonResponse(array('result' => false, 'message' => $message));
	    	}

	    	if($amount_with_iva == ''){
	    		$message = 'You have to insert an amount with iva.';
	    		return new JsonResponse(array('result' => false, 'message' => $message));
	    	}

	    	if($total == ''){
	    		$message = 'You have to insert the total with iva.';
	    		return new JsonResponse(array('result' => false, 'message' => $message));
	    	}

	    	try{
		    	$bill = new Bills();
		    	$bill->setDate($date_obj);
		    	$bill->setNumber($number);
		    	$bill->setFkUser($user);

		    	$em->persist($bill);
		    	$em->flush();

		    	$bill_row = new BillRows();
		    	$bill_row->setFkBill($bill);
		    	$bill_row->setDescription($description);
		    	$bill_row->setQuantity($quantity);
		    	$bill_row->setAmountIvaFree($amount_free_iva);
		    	$bill_row->setAmountIvaIncluded($amount_with_iva);
		    	$bill_row->setTotalIvaIncluded($total);

		    	$em->persist($bill_row);
		    	$em->flush();

		    	$message = 'Bill added successfully';
	    	}
	    	catch(\Exeption $e){ 
	    		return new JsonResponse(array( 'result' => false, 'message' => 'There is an issue somewhere. It will be fixed as soon as possible.'));
	    	}

			return new JsonResponse(array('result' => true, 'message' => $message ));

		}
		
		 /**
	     * @Route("/delete_bill/{id}", name="deleteBill")
	     */
		public function deleteBillAction($id)
		{
			$em = $this->getDoctrine()->getManager();

			$bill = $this->getDoctrine()->getRepository(Bills::class)->find($id);

			try{
				$em->remove($bill);
				$em->flush();

			}
			catch(\Exeption $e){
				$response = array('status' => 'true', 'response' => 0, 'message' => 'There are some issues. Please, try again later.');
			}

			$response = array('status' => 'true', 'response' => 1, 'message' => 'Bill deleted successfully.');

	        return new JsonResponse($response);
		}
    }
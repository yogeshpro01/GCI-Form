<?php
	namespace Drupal\gci_form\Form;

	use Drupal\Core\Form\FormBase;
	use Drupal\Core\Form\FormStateInterface; 

	class gciform extends FormBase{
		public function getFormId(){
			return 'gci_form';
		}
		public function buildForm(array $form, FormStateInterface $form_state){
			$form['name'] = array(
				'#type' => 'textfield',
				'#title' => t('Name'),
				'#required' => TRUE,
			);
			$form['age'] = array(
				'#type' => 'number',
				'#title' => t('Age'),
				'#required' => TRUE,
			);
			$form['gender'] = array(
				'#type' => 'select',
				'#title' => t('Gender'),
				'#required' => TRUE,
				'#options' => array(
					'male' => t('Male'),
					'female' => t('Female'),
					'others' => t('Others'),
				),
			);
			$form['birthdate'] = array(
				'#type' => 'date',
				'#title' => t('Birth Date'),
				'#required' => TRUE,
			);
			$form['actions']['#type'] = 'actions';
			$form['actions']['submit'] = array(
				'#type' => 'submit',
				'#value' => $this->t('Send'),
				'#button_type' => 'primary',
			);
			return $form;
		}	
		public function validateForm(array &$form, FormStateInterface $form_state){
			if($form_state->getValue('age') > 100){
				$form_state->setErrorByName('age',$this->t('Too old!'));
			}
			if(strlen($form_state->getValue('name')) < 3){
				$form_state->setErrorByName('name',$this->t('Invalid name!'));
			}
		}
		public function submitForm(array &$form, FormStateInterface $form_state){
        		drupal_set_message('Your name: '.$form_state->getValue('name'));
        		drupal_set_message('Your age: '.$form_state->getValue('age'));
        		drupal_set_message('You gender: '.$form_state->getValue('gender'));
        		drupal_set_message('Your birthdate: '.date("d-m-Y",strtotime($form_state->getValue('birthdate'))));
    		}
	}

?>

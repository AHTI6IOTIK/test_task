<?

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Error;
use Bitrix\Main\Loader;

use Bitrix\Sender\Transport;
use Bitrix\Sender\Security;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

Loc::loadMessages(__FILE__);

class SenderConfigLimitsComponent extends CBitrixComponent
{
	/** @var ErrorCollection $errors Errors. */
	protected $errors;

	protected function checkRequiredParams()
	{
		return true;
	}

	protected function initParams()
	{
		$this->arParams['SET_TITLE'] = isset($this->arParams['SET_TITLE']) ? $this->arParams['SET_TITLE'] == 'Y' : true;
		$this->arParams['CAN_EDIT'] = isset($this->arParams['CAN_EDIT'])
			?
			$this->arParams['CAN_EDIT']
			:
			Security\Access::current()->canModifySettings();
	}

	protected function prepareResult()
	{
		/* Set title */
		if ($this->arParams['SET_TITLE'])
		{
			/**@var CAllMain*/
			$GLOBALS['APPLICATION']->SetTitle(Loc::getMessage('SENDER_CONFIG_LIMITS_TITLE'));
		}

		if (!$this->arParams['CAN_EDIT'])
		{
			Security\AccessChecker::addError($this->errors);
			return false;
		}

		$this->arResult['ACTION_URI'] = $this->getPath() . '/ajax.php';

		$list = array();
		$transports = Transport\Factory::getTransports();
		foreach ($transports as $transport)
		{
			$transport = new Transport\Adapter($transport);
			if (!$transport->hasLimiters())
			{
				continue;
			}

			$helpUri = $helpCaption = null;
			$limits = array();
			foreach ($transport->getLimiters() as $limiter)
			{
				/** @var Transport\CountLimiter $limiter */
				$isCountLimiter = $limiter instanceof Transport\CountLimiter;

				$current = $limiter->getCurrent() ?: 0;
				$limit = $limiter->getLimit() ?: 1;

				$available = $limit - $current;
				$available = $available > 0 ? $available : 0;

				$initialLimit = $isCountLimiter ? $limiter->getInitialLimit() : 0;
				$initialLimit = $initialLimit ?: 1;

				$percentage = $isCountLimiter ? ceil(($current / $initialLimit) * 100) : 0;
				$percentage = $percentage > 100 ? 100 : 0;

				$limits[] = array(
					'NAME' => $isCountLimiter ? $limiter->getName() : null,
					'AVAILABLE' => number_format($available, 0, '.', ' '),
					'CURRENT' => number_format($current, 0, '.', ' '),
					'CURRENT_PERCENTAGE' => $percentage,
					'LIMIT' => number_format($limit, 0, '.', ' '),
					'UNIT_NAME' => $limiter->getUnitName(),
					'CAPTION' => $limiter->getCaption(),
					'SETUP_URI' => $limiter->getParameter('setupUri'),
					'SETUP_CAPTION' => $limiter->getParameter('setupCaption'),
					'PERCENTAGE' => $limiter->getParameter('percentage'),
					'TEXT_VIEW' => $limiter->getParameter('textView'),
				);

				if ($limiter->getParameter('globalHelpUri'))
				{
					$helpUri = $limiter->getParameter('globalHelpUri');
				}
			}

			$list[] = array(
				'CODE' => $transport->getCode(),
				'NAME' => $transport->getName(),
				'LIMITS' => $limits,
				'HELP_URI' => $helpUri,
				'HELP_CAPTION' => $helpCaption
			);
		}

		$this->arResult['LIST'] = $list;

		return true;
	}

	protected function printErrors()
	{
		foreach ($this->errors as $error)
		{
			ShowError($error);
		}
	}

	public function executeComponent()
	{
		$this->errors = new ErrorCollection();
		if (!Loader::includeModule('sender'))
		{
			$this->errors->setError(new Error('Module `sender` is not installed.'));
			$this->printErrors();
			return;
		}

		$this->initParams();
		if (!$this->checkRequiredParams())
		{
			$this->printErrors();
			return;
		}

		if (!$this->prepareResult())
		{
			$this->printErrors();
			return;
		}

		$this->includeComponentTemplate();
	}
}
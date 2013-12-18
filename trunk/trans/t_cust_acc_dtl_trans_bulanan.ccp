<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_cust_acc_dtl_transGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" dataSource="select a.t_cust_account_id,
               to_char(trunc(a.trans_date),'yyyy-mm-dd') as trans_date_txt,
               sum (a.service_charge)as service_charge
        from t_cust_acc_dtl_trans a, t_cust_account b
        where a.t_cust_account_id = {t_cust_account_id}
          and a.t_cust_account_id = b.t_cust_account_id
          and not exists (select 1 from t_vat_setllement_dtl x where x.t_cust_acc_dtl_trans_id = a.t_cust_acc_dtl_trans_id)
        group by  a.t_cust_account_id, trunc(a.trans_date)" parameterTypeListName="ParameterTypeList">
			<Components>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="trans_date_txt" fieldSource="trans_date_txt" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_acc_dtl_transGridtrans_date_txt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="249" fieldSourceType="DBColumn" dataType="Float" html="False" name="service_charge" fieldSource="service_charge" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_acc_dtl_transGridservice_charge" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="253" fieldSourceType="DBColumn" dataType="Text" name="npwd" PathID="t_cust_acc_dtl_transGridnpwd">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="254" fieldSourceType="DBColumn" dataType="Text" name="trans_date" PathID="t_cust_acc_dtl_transGridtrans_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="192" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" wizardCaption="P App Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_dtl_transGridt_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="226"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="227"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="243" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="251" variable="t_cust_account_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_cust_account_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_cust_acc_dtl_trans_bulanan_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_cust_acc_dtl_trans_bulanan.php" forShow="True" url="t_cust_acc_dtl_trans_bulanan.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
			</Actions>
		</Event>
	</Events>
</Page>

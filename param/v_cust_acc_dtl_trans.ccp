<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" name="VIEWDETTRANS" connection="ConnSIKP" dataSource="select  c.trans_date, c.bill_no, c.service_desc, c.service_charge, c.vat_charge 
from t_vat_setllement a, 
t_vat_setllement_dtl b, 
t_cust_acc_dtl_trans c
where a.t_vat_setllement_id = b.t_vat_setllement_id and
      a.t_vat_setllement_id = {t_vat_setllement_id} and
      b.t_cust_acc_dtl_trans_id = c.t_cust_acc_dtl_trans_id and
      b.t_cust_account_id = {t_cust_account_id}" pageSizeLimit="100" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" pasteActions="pasteActions">
			<Components>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" name="trans_date" fieldSource="trans_date" PathID="VIEWDETTRANStrans_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="17" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="bill_no" fieldSource="bill_no" PathID="VIEWDETTRANSbill_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="46" fieldSourceType="DBColumn" dataType="Text" html="False" name="service_desc" fieldSource="service_desc" PathID="VIEWDETTRANSservice_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="47" fieldSourceType="DBColumn" dataType="Float" html="False" name="service_charge" fieldSource="service_charge" PathID="VIEWDETTRANSservice_charge" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="48" fieldSourceType="DBColumn" dataType="Float" html="False" name="vat_charge" fieldSource="vat_charge" PathID="VIEWDETTRANSvat_charge" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Button id="53" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="VIEWDETTRANSButton1">
<Components/>
<Events>
<Event name="OnClick" type="Client">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="54"/>
</Actions>
</Event>
</Events>
<Attributes/>
<Features/>
</Button>
</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="39"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="40"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="34" conditionType="Parameter" useIsNull="False" field="p_region_level_id" dataType="Float" searchConditionType="Equal" parameterType="Expression" parameterSource="3" logicOperator="Or" leftBrackets="1"/>
				<TableParameter id="38" conditionType="Parameter" useIsNull="False" field="p_region_level_id" dataType="Float" searchConditionType="Equal" parameterType="Expression" parameterSource="4" logicOperator="And" rightBrackets="1"/>
				<TableParameter id="36" conditionType="Parameter" useIsNull="False" field="upper(region_name)" dataType="Text" searchConditionType="Contains" parameterType="URL" parameterSource="s_keyword" logicOperator="Or" leftBrackets="1"/>
				<TableParameter id="37" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" searchConditionType="Contains" parameterType="URL" parameterSource="s_keyword" logicOperator="And" rightBrackets="1"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="51" variable="t_vat_setllement_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_vat_setllement_id"/>
<SQLParameter id="52" variable="t_cust_account_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_cust_account_id"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="v_cust_acc_dtl_trans_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="v_cust_acc_dtl_trans.php" forShow="True" url="v_cust_acc_dtl_trans.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>

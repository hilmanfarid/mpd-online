<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="None" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_laporan_piutang_pajak" wizardCaption="Search T Payment Receipt " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_skpdkb_nihil.ccp" PathID="t_laporan_piutang_pajak" pasteActions="pasteActions">
			<Components>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_laporan_piutang_pajakButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="year_code" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_laporan_piutang_pajakyear_code" required="True" caption="Periode Tahun">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" name="p_year_period_id" PathID="t_laporan_piutang_pajakp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Text" name="cetak_laporan" PathID="t_laporan_piutang_pajakcetak_laporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_laporan_piutang_pajakvat_code" required="False" caption="Ayat Pajak">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="20" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" PathID="t_laporan_piutang_pajakp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="21" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" PathID="t_laporan_piutang_pajakButton2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="23" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="status" wizardEmptyCaption="Select Value" PathID="t_laporan_piutang_pajakstatus" connection="ConnSIKP" _valueOfList="2" _nameOfList="BELUM BAYAR" dataSource="1;SUDAH BAYAR;2;BELUM BAYAR">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="True" name="Label1" PathID="Label1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_skpdkb_nihil_events.php" forShow="False" comment="//" codePage="windows-1252"/>
<CodeFile id="Code" language="PHPTemplates" name="t_skpdkb_nihil.php" forShow="True" url="t_skpdkb_nihil.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="10"/>
			</Actions>
		</Event>
	</Events>
</Page>
